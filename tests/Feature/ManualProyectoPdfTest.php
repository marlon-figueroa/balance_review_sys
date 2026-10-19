<?php

namespace Tests\Feature;

use App\Models\User;
use App\Services\ManualProyectoPdfService;
use Database\Seeders\RolesAndPermissionsSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ManualProyectoPdfTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();

        $this->seed(RolesAndPermissionsSeeder::class);
    }

    public function test_la_vista_del_manual_incluye_portada_e_indice(): void
    {
        $html = view('pdf.manual-proyecto', app(ManualProyectoPdfService::class)->datos())->render();

        $this->assertStringContainsString('Manual del sistema', $html);
        $this->assertStringContainsString('Índice', $html);
        $this->assertStringContainsString('contraportada', $html);
    }

    public function test_usuario_autenticado_puede_descargar_el_manual(): void
    {
        $usuario = User::factory()->create()->assignRole('Registrador');

        $this->actingAs($usuario)
            ->get(route('docs.manual'))
            ->assertOk()
            ->assertHeader('content-type', 'application/pdf');
    }
}
