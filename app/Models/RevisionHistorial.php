<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class RevisionHistorial extends Model
{
    protected $table = 'revision_historial';

    public $timestamps = true;

    protected $fillable = [
        'periodo_revision_id',
        'usuario_id',
        'accion',
        'estado_anterior',
        'estado_nuevo',
        'comentario',
    ];

    public function periodo(): BelongsTo
    {
        return $this->belongsTo(PeriodoRevision::class, 'periodo_revision_id');
    }

    public function usuario(): BelongsTo
    {
        return $this->belongsTo(User::class, 'usuario_id');
    }
}
