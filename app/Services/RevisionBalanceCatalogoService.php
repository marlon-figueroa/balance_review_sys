<?php

namespace App\Services;

use App\Models\CuentaContable;
use App\Models\PeriodoRevision;
use App\Support\CatalogoCuentasDemo;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\ValidationException;

class RevisionBalanceCatalogoService
{
    public function __construct(private RevisionBalanceProcesoService $proceso) {}

    public function codigosActivos(): Collection
    {
        return CuentaContable::query()->activas()->pluck('codigo');
    }

    public function buscarPorCodigo(string $codigo): ?CuentaContable
    {
        return CuentaContable::query()->activas()->where('codigo', $codigo)->first();
    }

    public function assertCodigoEnCatalogo(string $codigo): CuentaContable
    {
        $cuenta = $this->buscarPorCodigo($codigo);
        if ($cuenta === null) {
            throw ValidationException::withMessages([
                'codigo_cuenta' => "La cuenta {$codigo} no existe en el catálogo activo.",
            ]);
        }

        return $cuenta;
    }

    /**
     * @param  array<string, array{debe: float, haber: float, saldo: float}>|null  $saldosPorCodigo
     */
    public function cargarEnPeriodo(PeriodoRevision $periodo, ?array $saldosPorCodigo = null, bool $soloConSaldo = false): int
    {
        if (! $periodo->editable()) {
            throw ValidationException::withMessages([
                'periodo' => 'Solo se puede cargar el catálogo en periodos en borrador.',
            ]);
        }

        $cuentas = CuentaContable::query()->activas()->ordenadas()->get();
        if ($cuentas->isEmpty()) {
            throw ValidationException::withMessages([
                'catalogo' => 'No hay cuentas en el catálogo. Ejecute el seeder de demostración.',
            ]);
        }

        $saldosPorCodigo ??= [];

        return DB::transaction(function () use ($periodo, $cuentas, $saldosPorCodigo, $soloConSaldo) {
            $periodo->lineasBalanza()->delete();
            $insertadas = 0;

            foreach ($cuentas as $cuenta) {
                $mov = $saldosPorCodigo[$cuenta->codigo] ?? ['debe' => 0.0, 'haber' => 0.0, 'saldo' => 0.0];
                if ($soloConSaldo && (float) $mov['saldo'] === 0.0 && (float) $mov['debe'] === 0.0 && (float) $mov['haber'] === 0.0) {
                    continue;
                }

                $periodo->lineasBalanza()->create([
                    'codigo_cuenta' => $cuenta->codigo,
                    'nombre' => $cuenta->nombre,
                    'naturaleza' => $cuenta->naturaleza,
                    'debe' => $mov['debe'],
                    'haber' => $mov['haber'],
                    'saldo' => $mov['saldo'],
                ]);
                $insertadas++;
            }

            $this->proceso->ejecutar($periodo->fresh(['lineasBalanza', 'conciliaciones']));

            return $insertadas;
        });
    }

    public function cargarDemostrativoEquilibrado(PeriodoRevision $periodo, float $factorVariacion = 1.0): int
    {
        return $this->cargarEnPeriodo(
            $periodo,
            CatalogoCuentasDemo::saldosDemostrativos($factorVariacion),
            soloConSaldo: true,
        );
    }

    public function cargarEstructuraCatalogo(PeriodoRevision $periodo): int
    {
        return $this->cargarEnPeriodo($periodo, soloConSaldo: false);
    }

    public function contenidoCsvPlantilla(bool $conSaldosDemo = false): string
    {
        $cuentas = CuentaContable::query()->activas()->ordenadas()->get();
        $saldos = $conSaldosDemo ? CatalogoCuentasDemo::saldosDemostrativos() : [];

        $lineas = ["codigo_cuenta,nombre,naturaleza,debe,haber,saldo"];
        foreach ($cuentas as $cuenta) {
            $mov = $saldos[$cuenta->codigo] ?? ['debe' => 0, 'haber' => 0, 'saldo' => 0];
            $lineas[] = implode(',', [
                $cuenta->codigo,
                $this->escaparCsv($cuenta->nombre),
                $cuenta->naturaleza->value,
                number_format((float) $mov['debe'], 2, '.', ''),
                number_format((float) $mov['haber'], 2, '.', ''),
                number_format((float) $mov['saldo'], 2, '.', ''),
            ]);
        }

        return implode("\n", $lineas)."\n";
    }

    private function escaparCsv(string $valor): string
    {
        if (str_contains($valor, ',') || str_contains($valor, '"')) {
            return '"'.str_replace('"', '""', $valor).'"';
        }

        return $valor;
    }
}
