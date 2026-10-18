<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Services\RevisionBalanceDashboardService;
use Illuminate\View\View;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class HomeController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(RevisionBalanceDashboardService $dashboard): View
    {
        $user = auth()->user();
        $revisiones = $dashboard->kpis($user);

        $statsAdmin = [];

        if ($user->can('usuarios.ver')) {
            $statsAdmin[] = [
                'label' => 'Usuarios',
                'total' => User::count(),
                'icon' => 'people',
                'color' => 'primary',
                'route' => route('admin.usuarios.index'),
            ];
        }

        if ($user->can('roles.ver')) {
            $statsAdmin[] = [
                'label' => 'Roles',
                'total' => Role::count(),
                'icon' => 'person-badge',
                'color' => 'success',
                'route' => route('admin.roles.index'),
            ];
        }

        if ($user->can('permisos.ver')) {
            $statsAdmin[] = [
                'label' => 'Permisos',
                'total' => Permission::count(),
                'icon' => 'key',
                'color' => 'warning',
                'route' => route('admin.permisos.index'),
            ];
        }

        return view('home', compact('revisiones', 'statsAdmin'));
    }
}
