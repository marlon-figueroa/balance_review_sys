<?php

namespace Tests\Feature\Revisiones;

use App\Enums\EstadoPeriodoRevision;
use App\Models\PeriodoRevision;
use App\Models\User;
use Database\Seeders\RolesAndPermissionsSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Carbon;
use Tests\TestCase;

class RevisionBalancePdfVacioTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();

        $this->seed(RolesAndPermissionsSeeder::class);
    }

    public function test_las_tablas_vacias_del_pdf_muestran_no_hay_registros(): void
    {
        Carbon::setTestNow('2026-10-18 16:30:00');
        $usuario = User::factory()->create(['name' => 'María Gerencia']);

        $periodo = PeriodoRevision::create([
            'anio' => 2026,
            'mes' => 6,
            'estado' => EstadoPeriodoRevision::Certificado,
            'usuario_creador_id' => $usuario->id,
        ]);

        $html = view('revisiones.pdf', [
            'periodo' => $periodo,
            'generadoEn' => now(),
            'generadoPor' => $usuario->name,
        ])->render();

        $this->assertSame(2, substr_count($html, 'No hay registros'));
        $this->assertStringContainsString('Generado el 18/10/2026 16:30', $html);
        $this->assertStringContainsString('por María Gerencia', $html);
        $this->assertStringContainsString('Página {PAGE_NUM}/{PAGE_COUNT}', $html);

        Carbon::setTestNow();
    }
}
