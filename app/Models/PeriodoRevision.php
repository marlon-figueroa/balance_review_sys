<?php

namespace App\Models;

use App\Enums\EstadoPeriodoRevision;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class PeriodoRevision extends Model
{
    protected $table = 'periodos_revision';

    protected $fillable = [
        'anio',
        'mes',
        'estado',
        'usuario_creador_id',
        'certificado_por_id',
        'total_activo',
        'total_pasivo',
        'total_patrimonio',
        'integridad_ok',
        'kpis',
        'comentario_rechazo',
        'certificado_at',
    ];

    protected function casts(): array
    {
        return [
            'estado' => EstadoPeriodoRevision::class,
            'integridad_ok' => 'boolean',
            'kpis' => 'array',
            'certificado_at' => 'datetime',
            'total_activo' => 'decimal:2',
            'total_pasivo' => 'decimal:2',
            'total_patrimonio' => 'decimal:2',
        ];
    }

    public function etiquetaPeriodo(): string
    {
        return sprintf('%02d/%d', $this->mes, $this->anio);
    }

    public function editable(): bool
    {
        return $this->estado === EstadoPeriodoRevision::Borrador;
    }

    public function creador(): BelongsTo
    {
        return $this->belongsTo(User::class, 'usuario_creador_id');
    }

    public function certificador(): BelongsTo
    {
        return $this->belongsTo(User::class, 'certificado_por_id');
    }

    public function lineasBalanza(): HasMany
    {
        return $this->hasMany(LineaBalanza::class, 'periodo_revision_id');
    }

    public function conciliaciones(): HasMany
    {
        return $this->hasMany(Conciliacion::class, 'periodo_revision_id');
    }

    public function hallazgos(): HasMany
    {
        return $this->hasMany(Hallazgo::class, 'periodo_revision_id');
    }

    public function ajustes(): HasMany
    {
        return $this->hasMany(AjusteContable::class, 'periodo_revision_id');
    }

    public function historial(): HasMany
    {
        return $this->hasMany(RevisionHistorial::class, 'periodo_revision_id')->latest();
    }
}
