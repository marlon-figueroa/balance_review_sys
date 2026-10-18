<?php

namespace Tests\Feature\Revisiones;

use App\Enums\EstadoPeriodoRevision;
use App\Models\PeriodoRevision;
use App\Models\User;
use Database\Seeders\RolesAndPermissionsSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
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
        $periodo = PeriodoRevision::create([
            'anio' => 2026,
            'mes' => 6,
            'estado' => EstadoPeriodoRevision::Certificado,
            'usuario_creador_id' => User::factory()->create()->id,
        ]);

        $html = view('revisiones.pdf', compact('periodo'))->render();

        $this->assertSame(2, substr_count($html, 'No hay registros'));
    }
}
