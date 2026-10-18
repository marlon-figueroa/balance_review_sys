<?php

namespace Database\Seeders;

use App\Enums\EstadoPeriodoRevision;
use App\Enums\NaturalezaCuenta;
use App\Models\PeriodoRevision;
use App\Models\User;
use App\Services\RevisionBalanceProcesoService;
use Illuminate\Database\Seeder;

class RevisionBalanceDemoSeeder extends Seeder
{
    public function run(): void
    {
        if (PeriodoRevision::query()->exists()) {
            return;
        }

        $registrador = User::role('Registrador')->first() ?? User::first();
        $aprobador = User::role('Aprobador')->first() ?? User::first();
        $proceso = app(RevisionBalanceProcesoService::class);

        $certificado = PeriodoRevision::create([
            'anio' => 2026,
            'mes' => 9,
            'estado' => EstadoPeriodoRevision::Certificado,
            'usuario_creador_id' => $registrador->id,
            'certificado_por_id' => $aprobador->id,
            'certificado_at' => now()->subMonth(),
        ]);

        $this->lineasEquilibradas($certificado);
        $certificado->conciliaciones()->create([
            'tipo' => 'banco',
            'referencia' => 'Cuenta operativa 001',
            'saldo_contable' => 50000,
            'saldo_externo' => 50000,
            'diferencia' => 0,
        ]);
        $proceso->ejecutar($certificado->fresh(['lineasBalanza', 'conciliaciones']));

        $borrador = PeriodoRevision::create([
            'anio' => 2026,
            'mes' => 10,
            'estado' => EstadoPeriodoRevision::Borrador,
            'usuario_creador_id' => $registrador->id,
        ]);

        $this->lineasEquilibradas($borrador, variacion: true);
        $borrador->conciliaciones()->create([
            'tipo' => 'banco',
            'referencia' => 'Cuenta operativa 001',
            'saldo_contable' => 52000,
            'saldo_externo' => 51500,
            'diferencia' => 500,
        ]);
        $proceso->ejecutar($borrador->fresh(['lineasBalanza', 'conciliaciones']));
    }

    private function lineasEquilibradas(PeriodoRevision $periodo, bool $variacion = false): void
    {
        $factor = $variacion ? 1.35 : 1.0;
        $lineas = [
            ['1101', 'Caja', NaturalezaCuenta::Activo, 10000 * $factor],
            ['1102', 'Bancos', NaturalezaCuenta::Activo, 50000 * $factor],
            ['1201', 'Inventarios', NaturalezaCuenta::Activo, 40000],
            ['2101', 'Proveedores', NaturalezaCuenta::Pasivo, 30000],
            ['2201', 'Préstamos CP', NaturalezaCuenta::Pasivo, 20000],
            ['3101', 'Capital social', NaturalezaCuenta::Patrimonio, 50000],
        ];

        foreach ($lineas as [$codigo, $nombre, $naturaleza, $saldo]) {
            $periodo->lineasBalanza()->create([
                'codigo_cuenta' => $codigo,
                'nombre' => $nombre,
                'naturaleza' => $naturaleza,
                'debe' => $saldo,
                'haber' => 0,
                'saldo' => $saldo,
            ]);
        }
    }
}
