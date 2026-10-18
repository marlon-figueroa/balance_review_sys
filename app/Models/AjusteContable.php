<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class AjusteContable extends Model
{
    protected $table = 'ajustes_contables';

    protected $fillable = [
        'periodo_revision_id',
        'hallazgo_id',
        'usuario_id',
        'codigo_cuenta',
        'monto',
        'descripcion',
        'estado',
    ];

    protected function casts(): array
    {
        return [
            'monto' => 'decimal:2',
        ];
    }

    public function periodo(): BelongsTo
    {
        return $this->belongsTo(PeriodoRevision::class, 'periodo_revision_id');
    }

    public function hallazgo(): BelongsTo
    {
        return $this->belongsTo(Hallazgo::class, 'hallazgo_id');
    }

    public function usuario(): BelongsTo
    {
        return $this->belongsTo(User::class, 'usuario_id');
    }
}
