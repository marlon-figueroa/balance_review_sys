<?php

namespace App\Models;

use App\Enums\SeveridadHallazgo;
use App\Enums\TipoHallazgo;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Hallazgo extends Model
{
    protected $fillable = [
        'periodo_revision_id',
        'tipo',
        'severidad',
        'codigo_cuenta',
        'titulo',
        'descripcion',
        'metadata',
    ];

    protected function casts(): array
    {
        return [
            'tipo' => TipoHallazgo::class,
            'severidad' => SeveridadHallazgo::class,
            'metadata' => 'array',
        ];
    }

    public function periodo(): BelongsTo
    {
        return $this->belongsTo(PeriodoRevision::class, 'periodo_revision_id');
    }

    public function ajustes(): HasMany
    {
        return $this->hasMany(AjusteContable::class, 'hallazgo_id');
    }
}
