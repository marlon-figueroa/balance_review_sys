<?php

namespace App\Providers;

use App\Models\AjusteContable;
use App\Models\Conciliacion;
use App\Models\CuentaContable;
use App\Models\Hallazgo;
use App\Models\LineaBalanza;
use App\Models\PeriodoRevision;
use App\Models\User;
use App\Observers\BitacoraObserver;
use App\Services\MenuService;
use Carbon\Carbon;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class AppServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        //
    }

    public function boot(): void
    {
        Paginator::useBootstrapFive();

        Carbon::setLocale(config('app.locale'));

        Gate::before(fn ($user) => $user->hasRole('Administrador') ? true : null);

        Gate::define('viewPulse', fn (User $user) => $user->can('monitoreo.pulse'));
        Gate::define('viewLogViewer', fn (User $user) => $user->can('monitoreo.logs'));

        View::composer('layouts.partials.sidebar', function ($view) {
            $view->with('menu', app(MenuService::class)->construir(auth()->user()));
        });

        User::observe(BitacoraObserver::class);
        Role::observe(BitacoraObserver::class);
        Permission::observe(BitacoraObserver::class);
        CuentaContable::observe(BitacoraObserver::class);
        PeriodoRevision::observe(BitacoraObserver::class);
        LineaBalanza::observe(BitacoraObserver::class);
        Conciliacion::observe(BitacoraObserver::class);
        Hallazgo::observe(BitacoraObserver::class);
        AjusteContable::observe(BitacoraObserver::class);
    }
}
