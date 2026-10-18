<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Conciliacion extends Model
{
    protected $table = 'conciliaciones';

    protected $fillable = [
        'periodo_revision_id',
        'tipo',
        'referencia',
        'saldo_contable',
        'saldo_externo',
        'diferencia',
    ];

    protected function casts(): array
    {
        return [
            'saldo_contable' => 'decimal:2',
            'saldo_externo' => 'decimal:2',
            'diferencia' => 'decimal:2',
        ];
    }

    public function periodo(): BelongsTo
    {
        return $this->belongsTo(PeriodoRevision::class, 'periodo_revision_id');
    }
}
