<?php

namespace App\Models;

use App\Enums\NaturalezaCuenta;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class LineaBalanza extends Model
{
    protected $table = 'lineas_balanza';

    protected $fillable = [
        'periodo_revision_id',
        'codigo_cuenta',
        'nombre',
        'naturaleza',
        'debe',
        'haber',
        'saldo',
    ];

    protected function casts(): array
    {
        return [
            'naturaleza' => NaturalezaCuenta::class,
            'debe' => 'decimal:2',
            'haber' => 'decimal:2',
            'saldo' => 'decimal:2',
        ];
    }

    public function periodo(): BelongsTo
    {
        return $this->belongsTo(PeriodoRevision::class, 'periodo_revision_id');
    }
}
