<?php

namespace App\Services;

use App\Enums\EstadoPeriodoRevision;
use App\Models\PeriodoRevision;
use App\Models\User;
use Illuminate\Support\Collection;

class PerfilService
{
    /**
     * @return array{periodos_creados: int, periodos_abiertos: int, periodos_certificados: int, hallazgos_periodos: int}
     */
    public function estadisticas(User $usuario): array
    {
        $creados = PeriodoRevision::query()->where('usuario_creador_id', $usuario->id);

        return [
            'periodos_creados' => (clone $creados)->count(),
            'periodos_abiertos' => (clone $creados)->whereIn('estado', [
                EstadoPeriodoRevision::Borrador,
                EstadoPeriodoRevision::EnRevision,
                EstadoPeriodoRevision::Aprobado,
            ])->count(),
            'periodos_certificados' => PeriodoRevision::query()
                ->where('usuario_creador_id', $usuario->id)
                ->where('estado', EstadoPeriodoRevision::Certificado)
                ->count(),
            'hallazgos_periodos' => PeriodoRevision::query()
                ->where('usuario_creador_id', $usuario->id)
                ->withCount('hallazgos')
                ->get()
                ->sum('hallazgos_count'),
        ];
    }

    /**
     * @return Collection<int, PeriodoRevision>
     */
    public function periodosRecientes(User $usuario, int $limite = 10): Collection
    {
        return PeriodoRevision::query()
            ->where('usuario_creador_id', $usuario->id)
            ->orderByDesc('anio')
            ->orderByDesc('mes')
            ->limit($limite)
            ->get();
    }
}
