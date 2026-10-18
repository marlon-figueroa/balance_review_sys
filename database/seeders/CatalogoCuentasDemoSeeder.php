<?php

namespace Database\Seeders;

use App\Models\CuentaContable;
use App\Support\CatalogoCuentasDemo;
use Illuminate\Database\Seeder;

class CatalogoCuentasDemoSeeder extends Seeder
{
    public function run(): void
    {
        foreach (CatalogoCuentasDemo::cuentas() as $datos) {
            CuentaContable::query()->updateOrCreate(
                ['codigo' => $datos['codigo']],
                [
                    'nombre' => $datos['nombre'],
                    'naturaleza' => $datos['naturaleza'],
                    'es_corriente' => $datos['es_corriente'],
                    'activa' => true,
                    'orden' => $datos['orden'],
                    'descripcion' => $datos['descripcion'] ?? null,
                ],
            );
        }
    }
}
