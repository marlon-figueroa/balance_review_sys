<?php

namespace App\Policies;

use App\Models\CuentaContable;
use App\Models\User;

class CuentaContablePolicy
{
    public function viewAny(User $user): bool
    {
        return $user->can('catalogo.ver');
    }

    public function view(User $user, CuentaContable $cuentaContable): bool
    {
        return $user->can('catalogo.ver');
    }

    public function create(User $user): bool
    {
        return $user->can('catalogo.gestionar');
    }

    public function update(User $user, CuentaContable $cuentaContable): bool
    {
        return $user->can('catalogo.gestionar');
    }

    public function delete(User $user, CuentaContable $cuentaContable): bool
    {
        return $user->can('catalogo.gestionar');
    }
}
