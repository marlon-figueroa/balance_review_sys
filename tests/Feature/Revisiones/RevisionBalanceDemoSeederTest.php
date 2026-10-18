<?php

namespace Tests\Feature\Revisiones;

use App\Enums\EstadoPeriodoRevision;
use App\Models\PeriodoRevision;
use Database\Seeders\CatalogoCuentasDemoSeeder;
use Database\Seeders\RevisionBalanceDemoSeeder;
use Database\Seeders\RolesAndPermissionsSeeder;
use Database\Seeders\UsuariosSeeders;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class RevisionBalanceDemoSeederTest extends TestCase
{
    use RefreshDatabase;

    public function test_seeder_crea_periodo_certificado_y_borrador(): void
    {
        $this->seed(RolesAndPermissionsSeeder::class);
        $this->seed(UsuariosSeeders::class);
        $this->seed(CatalogoCuentasDemoSeeder::class);
        $this->seed(RevisionBalanceDemoSeeder::class);

        $this->assertSame(2, PeriodoRevision::query()->count());

        $certificado = PeriodoRevision::query()->where('mes', 9)->first();
        $this->assertNotNull($certificado);
        $this->assertSame(EstadoPeriodoRevision::Certificado, $certificado->estado);
        $this->assertTrue($certificado->integridad_ok);
        $this->assertGreaterThan(0, $certificado->lineasBalanza()->count());

        $borrador = PeriodoRevision::query()->where('mes', 10)->first();
        $this->assertNotNull($borrador);
        $this->assertSame(EstadoPeriodoRevision::Borrador, $borrador->estado);
    }
}
