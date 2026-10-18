<?php

namespace App\Policies;

use App\Enums\EstadoPeriodoRevision;
use App\Models\PeriodoRevision;
use App\Models\User;

class PeriodoRevisionPolicy
{
    public function viewAny(User $user): bool
    {
        return $user->can('revisiones.ver');
    }

    public function view(User $user, PeriodoRevision $periodo): bool
    {
        if (! $user->can('revisiones.ver')) {
            return false;
        }

        if ($user->can('revisiones.reportes') && ! $user->canAny(['revisiones.crear', 'revisiones.revisar', 'revisiones.certificar'])) {
            return $periodo->estado === EstadoPeriodoRevision::Certificado;
        }

        return true;
    }

    public function create(User $user): bool
    {
        return $user->can('revisiones.crear');
    }

    public function update(User $user, PeriodoRevision $periodo): bool
    {
        return $user->can('revisiones.editar') && $periodo->editable();
    }

    public function import(User $user, PeriodoRevision $periodo): bool
    {
        return $this->update($user, $periodo);
    }

    public function flujo(User $user, PeriodoRevision $periodo): bool
    {
        return $user->canAny(['revisiones.enviar', 'revisiones.revisar', 'revisiones.certificar']);
    }

    public function reporte(User $user, PeriodoRevision $periodo): bool
    {
        if (! $user->can('revisiones.reportes')) {
            return false;
        }

        return $periodo->estado === EstadoPeriodoRevision::Certificado
            || $user->canAny(['revisiones.revisar', 'revisiones.certificar', 'revisiones.crear']);
    }
}
