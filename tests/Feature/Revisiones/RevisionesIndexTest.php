<?php

namespace Tests\Feature\Revisiones;

use App\Models\PeriodoRevision;
use App\Models\User;
use Database\Seeders\RolesAndPermissionsSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class RevisionesIndexTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();

        $this->seed(RolesAndPermissionsSeeder::class);
    }

    public function test_el_listado_carga_y_el_datatable_responde(): void
    {
        $registrador = User::factory()->create()->assignRole('Registrador');

        PeriodoRevision::create([
            'anio' => 2026,
            'mes' => 1,
            'usuario_creador_id' => $registrador->id,
        ]);

        $this->actingAs($registrador)
            ->get(route('revisiones.index'))
            ->assertOk()
            ->assertSee('tabla-revisiones', false);

        $this->actingAs($registrador)
            ->postJson(route('revisiones.data'), [
                'draw' => 1,
                'start' => 0,
                'length' => 10,
                'columns' => array_fill(0, 6, ['data' => 'id', 'searchable' => 'true', 'orderable' => 'true', 'search' => ['value' => '', 'regex' => 'false']]),
                'order' => [['column' => 0, 'dir' => 'desc']],
                'search' => ['value' => '', 'regex' => 'false'],
            ])
            ->assertOk()
            ->assertJsonStructure(['draw', 'recordsTotal', 'recordsFiltered', 'data']);
    }
}
