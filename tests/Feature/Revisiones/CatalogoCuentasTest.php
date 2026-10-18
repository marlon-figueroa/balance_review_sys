<?php

namespace Tests\Feature\Revisiones;

use App\Models\CuentaContable;
use App\Models\PeriodoRevision;
use App\Models\User;
use Database\Seeders\CatalogoCuentasDemoSeeder;
use Database\Seeders\RolesAndPermissionsSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class CatalogoCuentasTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();
        $this->seed(RolesAndPermissionsSeeder::class);
        $this->seed(CatalogoCuentasDemoSeeder::class);
    }

    public function test_catalogo_demostrativo_se_siembra(): void
    {
        $this->assertGreaterThanOrEqual(10, CuentaContable::query()->activas()->count());
        $this->assertNotNull(CuentaContable::query()->where('codigo', '1102')->first());
    }

    public function test_registrador_carga_balanza_demostrativa_desde_catalogo(): void
    {
        $registrador = User::factory()->create()->assignRole('Registrador');
        $periodo = PeriodoRevision::create([
            'anio' => 2026,
            'mes' => 3,
            'usuario_creador_id' => $registrador->id,
        ]);

        $this->actingAs($registrador)
            ->post(route('revisiones.cargar-catalogo', $periodo), ['modo' => 'demo'])
            ->assertRedirect();

        $periodo->refresh();
        $this->assertTrue($periodo->integridad_ok);
        $this->assertGreaterThan(0, $periodo->lineasBalanza()->count());
    }

    public function test_gerencia_ve_catalogo_sin_gestionar(): void
    {
        $gerencia = User::factory()->create()->assignRole('Gerencia');

        $this->actingAs($gerencia)
            ->get(route('revisiones.catalogo.index'))
            ->assertOk();

        $this->actingAs($gerencia)
            ->get(route('revisiones.catalogo.create'))
            ->assertForbidden();
    }
}
