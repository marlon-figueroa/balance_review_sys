<?php

namespace App\Services;

use App\Enums\EstadoPeriodoRevision;
use App\Enums\SeveridadHallazgo;
use App\Models\PeriodoRevision;
use App\Models\User;

class RevisionBalanceDashboardService
{
    public function kpis(?User $usuario): array
    {
        $query = PeriodoRevision::query();

        if ($usuario !== null && $usuario->can('revisiones.reportes') && ! $usuario->can('revisiones.revisar')) {
            $query->where('estado', EstadoPeriodoRevision::Certificado);
        }

        $ultimoCertificado = (clone $query)
            ->where('estado', EstadoPeriodoRevision::Certificado)
            ->orderByDesc('anio')
            ->orderByDesc('mes')
            ->first();

        return [
            'periodos_abiertos' => PeriodoRevision::query()
                ->whereIn('estado', [EstadoPeriodoRevision::Borrador, EstadoPeriodoRevision::EnRevision, EstadoPeriodoRevision::Aprobado])
                ->count(),
            'en_revision' => PeriodoRevision::query()->where('estado', EstadoPeriodoRevision::EnRevision)->count(),
            'hallazgos_criticos' => $ultimoCertificado
                ? $ultimoCertificado->hallazgos()->where('severidad', SeveridadHallazgo::Critico)->count()
                : 0,
            'ultimo_certificado' => $ultimoCertificado,
            'kpis_ultimo' => $ultimoCertificado?->kpis ?? [],
        ];
    }
}
