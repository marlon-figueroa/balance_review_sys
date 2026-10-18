<?php

namespace Database\Factories;

use App\Enums\NaturalezaCuenta;
use App\Models\CuentaContable;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<CuentaContable>
 */
class CuentaContableFactory extends Factory
{
    protected $model = CuentaContable::class;

    public function definition(): array
    {
        $naturaleza = fake()->randomElement(NaturalezaCuenta::cases());
        $prefijo = match ($naturaleza) {
            NaturalezaCuenta::Activo => '11',
            NaturalezaCuenta::Pasivo => '21',
            NaturalezaCuenta::Patrimonio => '31',
        };

        return [
            'codigo' => $prefijo.fake()->unique()->numerify('##'),
            'nombre' => fake()->words(3, true),
            'naturaleza' => $naturaleza,
            'es_corriente' => true,
            'activa' => true,
            'orden' => fake()->numberBetween(1, 999),
            'descripcion' => fake()->optional()->sentence(),
        ];
    }
}
