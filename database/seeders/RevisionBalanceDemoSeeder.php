<?php

namespace Database\Seeders;

use App\Enums\EstadoPeriodoRevision;
use App\Models\PeriodoRevision;
use App\Models\User;
use App\Services\RevisionBalanceCatalogoService;
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
        $catalogo = app(RevisionBalanceCatalogoService::class);

        $certificado = PeriodoRevision::create([
            'anio' => 2026,
            'mes' => 9,
            'estado' => EstadoPeriodoRevision::Borrador,
            'usuario_creador_id' => $registrador->id,
        ]);

        $catalogo->cargarDemostrativoEquilibrado($certificado);
        $certificado->conciliaciones()->create([
            'tipo' => 'banco',
            'referencia' => 'Cuenta operativa 001',
            'saldo_contable' => 50000,
            'saldo_externo' => 50000,
            'diferencia' => 0,
        ]);
        $proceso->ejecutar($certificado->fresh(['lineasBalanza', 'conciliaciones']));
        $certificado->update([
            'estado' => EstadoPeriodoRevision::Certificado,
            'certificado_por_id' => $aprobador->id,
            'certificado_at' => now()->subMonth(),
        ]);

        $borrador = PeriodoRevision::create([
            'anio' => 2026,
            'mes' => 10,
            'estado' => EstadoPeriodoRevision::Borrador,
            'usuario_creador_id' => $registrador->id,
        ]);

        $catalogo->cargarDemostrativoEquilibrado($borrador, 1.35);
        $borrador->conciliaciones()->create([
            'tipo' => 'banco',
            'referencia' => 'Cuenta operativa 001',
            'saldo_contable' => 52000,
            'saldo_externo' => 51500,
            'diferencia' => 500,
        ]);
        $proceso->ejecutar($borrador->fresh(['lineasBalanza', 'conciliaciones']));
    }
}
