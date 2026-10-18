<?php

namespace Tests\Feature\Revisiones;

use App\Enums\EstadoPeriodoRevision;
use App\Enums\NaturalezaCuenta;
use App\Models\PeriodoRevision;
use App\Models\User;
use Database\Seeders\CatalogoCuentasDemoSeeder;
use Database\Seeders\RolesAndPermissionsSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Tests\TestCase;

class RevisionBalanceFlujoTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();
        $this->seed(RolesAndPermissionsSeeder::class);
        $this->seed(CatalogoCuentasDemoSeeder::class);
    }

    public function test_importacion_csv_valida_integridad(): void
    {
        $registrador = User::factory()->create()->assignRole('Registrador');
        $periodo = PeriodoRevision::create([
            'anio' => 2026,
            'mes' => 1,
            'usuario_creador_id' => $registrador->id,
        ]);

        $csv = "codigo_cuenta,nombre,naturaleza,debe,haber,saldo\n";
        $csv .= "1101,Caja,activo,100,0,100\n";
        $csv .= "2101,Proveedores,pasivo,0,50,50\n";
        $csv .= "3101,Capital,patrimonio,0,50,50\n";

        $archivo = UploadedFile::fake()->createWithContent('balanza.csv', $csv);

        $this->actingAs($registrador)
            ->post(route('revisiones.importar-balanza', $periodo), ['archivo' => $archivo])
            ->assertRedirect();

        $periodo->refresh();
        $this->assertTrue($periodo->integridad_ok);
        $this->assertSame(3, $periodo->lineasBalanza()->count());
    }

    public function test_flujo_feliz_registrar_revisar_certificar(): void
    {
        $registrador = User::factory()->create()->assignRole('Registrador');
        $revisor = User::factory()->create()->assignRole('Revisor');
        $aprobador = User::factory()->create()->assignRole('Aprobador');

        $periodo = PeriodoRevision::create([
            'anio' => 2026,
            'mes' => 2,
            'usuario_creador_id' => $registrador->id,
            'integridad_ok' => true,
            'total_activo' => 100,
            'total_pasivo' => 50,
            'total_patrimonio' => 50,
        ]);

        $this->actingAs($registrador)
            ->post(route('revisiones.flujo', [$periodo, 'enviar']))
            ->assertRedirect();

        $periodo->refresh();
        $this->assertSame(EstadoPeriodoRevision::EnRevision, $periodo->estado);

        $this->actingAs($revisor)
            ->post(route('revisiones.flujo', [$periodo, 'aprobar']))
            ->assertRedirect();

        $periodo->refresh();
        $this->assertSame(EstadoPeriodoRevision::Aprobado, $periodo->estado);

        $this->actingAs($aprobador)
            ->post(route('revisiones.flujo', [$periodo, 'certificar']))
            ->assertRedirect();

        $periodo->refresh();
        $this->assertSame(EstadoPeriodoRevision::Certificado, $periodo->estado);
        $this->assertNotNull($periodo->certificado_at);
    }

    public function test_segregacion_registrador_no_certifica(): void
    {
        $registrador = User::factory()->create()->assignRole(['Registrador', 'Aprobador']);
        $periodo = PeriodoRevision::create([
            'anio' => 2026,
            'mes' => 3,
            'estado' => EstadoPeriodoRevision::Aprobado,
            'usuario_creador_id' => $registrador->id,
            'integridad_ok' => true,
        ]);

        $this->actingAs($registrador)
            ->post(route('revisiones.flujo', [$periodo, 'certificar']))
            ->assertSessionHasErrors('accion');
    }

    public function test_gerencia_ve_pdf_certificado(): void
    {
        $gerencia = User::factory()->create()->assignRole('Gerencia');
        $periodo = PeriodoRevision::create([
            'anio' => 2026,
            'mes' => 4,
            'estado' => EstadoPeriodoRevision::Certificado,
            'usuario_creador_id' => User::factory()->create()->id,
            'certificado_at' => now(),
        ]);

        $periodo->lineasBalanza()->create([
            'codigo_cuenta' => '1101',
            'nombre' => 'Caja',
            'naturaleza' => NaturalezaCuenta::Activo,
            'debe' => 100,
            'haber' => 0,
            'saldo' => 100,
        ]);

        $this->actingAs($gerencia)
            ->get(route('revisiones.pdf', $periodo))
            ->assertOk();
    }
}
