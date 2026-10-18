<?php

namespace App\Services;

use App\Enums\NaturalezaCuenta;
use App\Enums\SeveridadHallazgo;
use App\Enums\EstadoPeriodoRevision;
use App\Enums\TipoHallazgo;
use App\Models\PeriodoRevision;
use Illuminate\Support\Facades\DB;

class RevisionBalanceProcesoService
{
    public function ejecutar(PeriodoRevision $periodo): void
    {
        DB::transaction(function () use ($periodo) {
            $periodo->load(['lineasBalanza', 'conciliaciones']);

            $periodo->hallazgos()->delete();

            $totales = $this->totalesPorNaturaleza($periodo);
            $periodo->total_activo = $totales[NaturalezaCuenta::Activo->value];
            $periodo->total_pasivo = $totales[NaturalezaCuenta::Pasivo->value];
            $periodo->total_patrimonio = $totales[NaturalezaCuenta::Patrimonio->value];

            $integridadOk = abs(
                (float) $periodo->total_activo - ((float) $periodo->total_pasivo + (float) $periodo->total_patrimonio)
            ) < 0.01;
            $periodo->integridad_ok = $integridadOk;

            if (! $integridadOk) {
                $periodo->hallazgos()->create([
                    'tipo' => TipoHallazgo::Integridad,
                    'severidad' => SeveridadHallazgo::Critico,
                    'titulo' => 'Ecuación contable incumplida',
                    'descripcion' => sprintf(
                        'Activo (%s) ≠ Pasivo (%s) + Patrimonio (%s).',
                        number_format((float) $periodo->total_activo, 2),
                        number_format((float) $periodo->total_pasivo, 2),
                        number_format((float) $periodo->total_patrimonio, 2),
                    ),
                    'metadata' => $totales,
                ]);
            }

            foreach ($periodo->conciliaciones as $conciliacion) {
                $diferencia = (float) $conciliacion->saldo_contable - (float) $conciliacion->saldo_externo;
                $conciliacion->update(['diferencia' => $diferencia]);

                if (abs($diferencia) >= 0.01) {
                    $periodo->hallazgos()->create([
                        'tipo' => TipoHallazgo::Conciliacion,
                        'severidad' => SeveridadHallazgo::Advertencia,
                        'titulo' => 'Diferencia en conciliación',
                        'descripcion' => sprintf(
                            '%s (%s): contable %s vs externo %s.',
                            ucfirst($conciliacion->tipo),
                            $conciliacion->referencia,
                            number_format((float) $conciliacion->saldo_contable, 2),
                            number_format((float) $conciliacion->saldo_externo, 2),
                        ),
                        'metadata' => ['diferencia' => $diferencia],
                    ]);
                }
            }

            $umbralSaldo = (float) config('balance_review.saldo_material', 1000);

            foreach ($periodo->lineasBalanza as $linea) {
                $saldo = (float) $linea->saldo;

                if ($linea->naturaleza === NaturalezaCuenta::Activo && $saldo < 0) {
                    $periodo->hallazgos()->create([
                        'tipo' => TipoHallazgo::Anomalia,
                        'severidad' => SeveridadHallazgo::Advertencia,
                        'codigo_cuenta' => $linea->codigo_cuenta,
                        'titulo' => 'Saldo negativo en activo',
                        'descripcion' => "{$linea->nombre} ({$linea->codigo_cuenta}) tiene saldo {$saldo}.",
                    ]);
                }

                if (in_array($linea->naturaleza, [NaturalezaCuenta::Pasivo, NaturalezaCuenta::Patrimonio], true) && $saldo < 0) {
                    $periodo->hallazgos()->create([
                        'tipo' => TipoHallazgo::Anomalia,
                        'severidad' => SeveridadHallazgo::Advertencia,
                        'codigo_cuenta' => $linea->codigo_cuenta,
                        'titulo' => 'Saldo negativo en pasivo/patrimonio',
                        'descripcion' => "{$linea->nombre} ({$linea->codigo_cuenta}) tiene saldo {$saldo}.",
                    ]);
                }

                if ((float) $linea->debe === 0.0 && (float) $linea->haber === 0.0 && abs($saldo) >= $umbralSaldo) {
                    $periodo->hallazgos()->create([
                        'tipo' => TipoHallazgo::Anomalia,
                        'severidad' => SeveridadHallazgo::Info,
                        'codigo_cuenta' => $linea->codigo_cuenta,
                        'titulo' => 'Saldo sin movimiento del periodo',
                        'descripcion' => "{$linea->codigo_cuenta} conserva saldo material sin debe/haber.",
                    ]);
                }
            }

            $this->analizarVariaciones($periodo);
            $periodo->kpis = $this->calcularKpis($periodo);
            $periodo->save();
        });
    }

    /**
     * @return array<string, float>
     */
    private function totalesPorNaturaleza(PeriodoRevision $periodo): array
    {
        $totales = [
            NaturalezaCuenta::Activo->value => 0.0,
            NaturalezaCuenta::Pasivo->value => 0.0,
            NaturalezaCuenta::Patrimonio->value => 0.0,
        ];

        foreach ($periodo->lineasBalanza as $linea) {
            $totales[$linea->naturaleza->value] += (float) $linea->saldo;
        }

        return $totales;
    }

    private function analizarVariaciones(PeriodoRevision $periodo): void
    {
        $anterior = PeriodoRevision::query()
            ->where('estado', EstadoPeriodoRevision::Certificado)
            ->where(function ($q) use ($periodo) {
                $q->where('anio', '<', $periodo->anio)
                    ->orWhere(function ($q2) use ($periodo) {
                        $q2->where('anio', $periodo->anio)->where('mes', '<', $periodo->mes);
                    });
            })
            ->orderByDesc('anio')
            ->orderByDesc('mes')
            ->first();

        if ($anterior === null) {
            return;
        }

        $saldosAnteriores = $anterior->lineasBalanza()->pluck('saldo', 'codigo_cuenta');
        $umbralPct = (float) config('balance_review.variacion_porcentaje_alerta', 25);

        foreach ($periodo->lineasBalanza as $linea) {
            if (! $saldosAnteriores->has($linea->codigo_cuenta)) {
                continue;
            }

            $prev = (float) $saldosAnteriores[$linea->codigo_cuenta];
            $actual = (float) $linea->saldo;
            $delta = $actual - $prev;
            $pct = abs($prev) < 0.01 ? ($actual !== 0.0 ? 100.0 : 0.0) : abs($delta / $prev * 100);

            if ($pct >= $umbralPct) {
                $periodo->hallazgos()->create([
                    'tipo' => TipoHallazgo::Variacion,
                    'severidad' => SeveridadHallazgo::Advertencia,
                    'codigo_cuenta' => $linea->codigo_cuenta,
                    'titulo' => 'Variación significativa',
                    'descripcion' => sprintf(
                        'Cuenta %s varió %.2f%% respecto al periodo %s.',
                        $linea->codigo_cuenta,
                        $pct,
                        $anterior->etiquetaPeriodo(),
                    ),
                    'metadata' => ['anterior' => $prev, 'actual' => $actual, 'porcentaje' => round($pct, 2)],
                ]);
            }
        }
    }

    /**
     * @return array<string, mixed>
     */
    public function calcularKpis(PeriodoRevision $periodo): array
    {
        $prefijos = config('balance_review.prefijos');
        $activoCorriente = $this->sumarPorPrefijos($periodo, $prefijos['activo_corriente'] ?? []);
        $pasivoCorriente = $this->sumarPorPrefijos($periodo, $prefijos['pasivo_corriente'] ?? []);
        $activo = (float) $periodo->total_activo;
        $pasivo = (float) $periodo->total_pasivo;

        $liquidez = $pasivoCorriente > 0 ? round($activoCorriente / $pasivoCorriente, 4) : null;
        $endeudamiento = $activo > 0 ? round($pasivo / $activo, 4) : null;
        $capitalTrabajo = round($activoCorriente - $pasivoCorriente, 2);

        $umbrales = config('balance_review.umbrales_kpi');
        $alertas = [];

        if ($liquidez !== null && $liquidez < ($umbrales['liquidez_minima'] ?? 1)) {
            $alertas[] = 'liquidez_baja';
            $periodo->hallazgos()->create([
                'tipo' => TipoHallazgo::Kpi,
                'severidad' => SeveridadHallazgo::Critico,
                'titulo' => 'Liquidez por debajo del umbral',
                'descripcion' => "Liquidez corriente {$liquidez} < mínimo {$umbrales['liquidez_minima']}.",
            ]);
        }

        if ($endeudamiento !== null && $endeudamiento > ($umbrales['endeudamiento_maximo'] ?? 0.7)) {
            $alertas[] = 'endeudamiento_alto';
            $periodo->hallazgos()->create([
                'tipo' => TipoHallazgo::Kpi,
                'severidad' => SeveridadHallazgo::Critico,
                'titulo' => 'Endeudamiento sobre el límite',
                'descripcion' => "Ratio de endeudamiento {$endeudamiento} supera {$umbrales['endeudamiento_maximo']}.",
            ]);
        }

        return [
            'liquidez_corriente' => $liquidez,
            'endeudamiento' => $endeudamiento,
            'capital_trabajo' => $capitalTrabajo,
            'alertas' => $alertas,
        ];
    }

    /**
     * @param  list<string>  $prefijos
     */
    private function sumarPorPrefijos(PeriodoRevision $periodo, array $prefijos): float
    {
        $total = 0.0;

        foreach ($periodo->lineasBalanza as $linea) {
            foreach ($prefijos as $prefijo) {
                if (str_starts_with($linea->codigo_cuenta, $prefijo)) {
                    $total += (float) $linea->saldo;
                    break;
                }
            }
        }

        return $total;
    }
}
