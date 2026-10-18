<?php

namespace Tests\Feature\Revisiones;

use App\Enums\EstadoPeriodoRevision;
use App\Models\PeriodoRevision;
use App\Models\User;
use App\Services\RevisionBalanceDiagramaService;
use Database\Seeders\RolesAndPermissionsSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class RevisionBalanceDiagramaTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();

        $this->seed(RolesAndPermissionsSeeder::class);
    }

    public function test_cada_paso_conserva_al_actor_que_ejecuto_la_transicion(): void
    {
        $registrador = User::factory()->create(['name' => 'Ana Registradora'])->assignRole('Registrador');
        $revisor = User::factory()->create(['name' => 'Luis Revisor'])->assignRole('Revisor');

        $periodo = PeriodoRevision::create([
            'anio' => 2026,
            'mes' => 3,
            'usuario_creador_id' => $registrador->id,
            'estado' => EstadoPeriodoRevision::EnRevision,
        ]);

        foreach ([
            ['usuario_id' => $registrador->id, 'accion' => 'crear', 'estado_anterior' => null, 'estado_nuevo' => EstadoPeriodoRevision::Borrador->value],
            ['usuario_id' => $registrador->id, 'accion' => 'enviar', 'estado_anterior' => EstadoPeriodoRevision::Borrador->value, 'estado_nuevo' => EstadoPeriodoRevision::EnRevision->value],
            ['usuario_id' => $revisor->id, 'accion' => 'aprobar', 'estado_anterior' => EstadoPeriodoRevision::EnRevision->value, 'estado_nuevo' => EstadoPeriodoRevision::Aprobado->value],
        ] as $paso) {
            $periodo->historial()->create($paso);
        }

        $pasos = app(RevisionBalanceDiagramaService::class)->pasos($periodo->fresh());

        $this->assertSame(
            ['Ana Registradora', 'Ana Registradora', 'Luis Revisor'],
            array_column($pasos, 'actor')
        );
        $this->assertSame(
            ['Registrador', 'Registrador', 'Revisor / Aprobador'],
            array_column($pasos, 'rol')
        );
        $this->assertTrue($pasos[2]['actual']);
        $this->assertSame('Aprobado', $pasos[2]['etapa']);
    }

    public function test_el_diagrama_es_una_maquina_de_estados_con_las_transiciones_recorridas(): void
    {
        $registrador = User::factory()->create()->assignRole('Registrador');
        $revisor = User::factory()->create()->assignRole('Revisor');

        $periodo = PeriodoRevision::create([
            'anio' => 2026,
            'mes' => 4,
            'usuario_creador_id' => $registrador->id,
            'estado' => EstadoPeriodoRevision::EnRevision,
        ]);

        foreach ([
            ['usuario_id' => $registrador->id, 'accion' => 'crear', 'estado_anterior' => null, 'estado_nuevo' => EstadoPeriodoRevision::Borrador->value],
            ['usuario_id' => $registrador->id, 'accion' => 'enviar', 'estado_anterior' => EstadoPeriodoRevision::Borrador->value, 'estado_nuevo' => EstadoPeriodoRevision::EnRevision->value],
            ['usuario_id' => $revisor->id, 'accion' => 'rechazar', 'estado_anterior' => EstadoPeriodoRevision::EnRevision->value, 'estado_nuevo' => EstadoPeriodoRevision::Borrador->value],
            ['usuario_id' => $registrador->id, 'accion' => 'enviar', 'estado_anterior' => EstadoPeriodoRevision::Borrador->value, 'estado_nuevo' => EstadoPeriodoRevision::EnRevision->value],
        ] as $paso) {
            $periodo->historial()->create($paso);
        }

        $diagrama = app(RevisionBalanceDiagramaService::class)->diagrama($periodo->fresh());

        $estados = collect($diagrama['estados'])->keyBy('id');
        $this->assertCount(count(EstadoPeriodoRevision::cases()), $estados);
        $this->assertTrue($estados['en_revision']['actual']);
        $this->assertTrue($estados['borrador']['visitado']);
        $this->assertFalse($estados['certificado']['visitado']);

        $transiciones = collect($diagrama['transiciones'])->keyBy(fn ($t) => "{$t['origen']}>{$t['destino']}");
        $this->assertSame([1], $transiciones['inicio>borrador']['pasos']);
        $this->assertSame(['rechazar'], $transiciones['en_revision>borrador']['eventos']);
        $this->assertTrue($transiciones['en_revision>borrador']['rechazo']);
        $this->assertSame([2, 4], $transiciones['borrador>en_revision']['pasos']);
        $this->assertSame([], $transiciones['en_revision>aprobado']['pasos']);
        $this->assertSame([], $transiciones['certificado>fin']['pasos']);

        $this->assertSame([2, 4], array_column($estados['en_revision']['eventos'], 'numero'));
        $this->assertTrue($estados['borrador']['eventos'][1]['rechazo']);
    }

    public function test_la_vista_del_periodo_incluye_el_diagrama(): void
    {
        $registrador = User::factory()->create(['name' => 'Ana Registradora'])->assignRole('Registrador');

        $periodo = PeriodoRevision::create([
            'anio' => 2026,
            'mes' => 5,
            'usuario_creador_id' => $registrador->id,
        ]);

        $periodo->historial()->create([
            'usuario_id' => $registrador->id,
            'accion' => 'crear',
            'estado_nuevo' => EstadoPeriodoRevision::Borrador->value,
        ]);

        $this->actingAs($registrador)
            ->get(route('revisiones.show', $periodo))
            ->assertOk()
            ->assertSee('Volver al listado', false)
            ->assertSee('Diagrama de estados', false)
            ->assertSee('page-action-group', false)
            ->assertSee('data-bs-target="#diagrama-modal"', false)
            ->assertSee('id="diagrama-modal"', false)
            ->assertSee('modal-diagrama', false)
            ->assertSee('id="diagrama-estados"', false)
            ->assertSee('Ana Registradora', false)
            ->assertSee('Registrador', false);
    }
}
