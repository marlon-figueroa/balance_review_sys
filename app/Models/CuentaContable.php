<?php

namespace App\Models;

use App\Enums\NaturalezaCuenta;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CuentaContable extends Model
{
    /** @use HasFactory<\Database\Factories\CuentaContableFactory> */
    use HasFactory;

    protected $table = 'cuentas_contables';

    protected $fillable = [
        'codigo',
        'nombre',
        'naturaleza',
        'es_corriente',
        'activa',
        'orden',
        'descripcion',
    ];

    protected function casts(): array
    {
        return [
            'naturaleza' => NaturalezaCuenta::class,
            'es_corriente' => 'boolean',
            'activa' => 'boolean',
            'orden' => 'integer',
        ];
    }

    public function scopeActivas(Builder $query): Builder
    {
        return $query->where('activa', true);
    }

    public function scopeOrdenadas(Builder $query): Builder
    {
        return $query->orderBy('codigo')->orderBy('orden');
    }

    public function etiquetaCompleta(): string
    {
        return "{$this->codigo} · {$this->nombre}";
    }
}
