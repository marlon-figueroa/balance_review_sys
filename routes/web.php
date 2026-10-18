<?php

use App\Http\Controllers\Admin\BitacoraController;
use App\Http\Controllers\Admin\PermissionController;
use App\Http\Controllers\Admin\RoleController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\NotificacionController;
use App\Http\Controllers\PerfilController;
use App\Http\Controllers\Revisiones\AjusteContableController;
use App\Http\Controllers\Revisiones\ConciliacionController;
use App\Http\Controllers\Revisiones\FlujoController;
use App\Http\Controllers\Revisiones\ImportBalanzaController;
use App\Http\Controllers\Revisiones\PeriodoRevisionController;
use App\Services\RevisionBalanceFlujoService;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Lab404\Impersonate\Controllers\ImpersonateController;

Route::redirect('/', '/home');

Auth::routes();

Route::middleware('auth')->group(function () {
    Route::get('/home', [HomeController::class, 'index'])->name('home');

    Route::get('perfil', [PerfilController::class, 'show'])->name('perfil.show');
    Route::put('perfil', [PerfilController::class, 'update'])->name('perfil.update');
    Route::put('perfil/contrasena', [PerfilController::class, 'updatePassword'])->name('perfil.password');

    Route::get('notificaciones', [NotificacionController::class, 'index'])->name('notificaciones.index');
    Route::post('notificaciones/{id}/leida', [NotificacionController::class, 'marcarLeida'])->name('notificaciones.leida');
    Route::post('notificaciones/leidas', [NotificacionController::class, 'marcarTodasLeidas'])->name('notificaciones.leidas');

    Route::post('impersonate/take/{id}', [ImpersonateController::class, 'take'])
        ->name('impersonate')
        ->whereNumber('id');
    Route::post('impersonate/leave', [ImpersonateController::class, 'leave'])
        ->name('impersonate.leave');

    Route::prefix('admin')->name('admin.')->group(function () {
        Route::post('usuarios/data', [UserController::class, 'data'])->name('usuarios.data');
        Route::get('usuarios/pdf', [UserController::class, 'pdf'])->name('usuarios.pdf');
        Route::resource('usuarios', UserController::class)
            ->parameters(['usuarios' => 'user'])
            ->except('show');

        Route::post('roles/data', [RoleController::class, 'data'])->name('roles.data');
        Route::resource('roles', RoleController::class)->except('show');

        Route::get('bitacora', [BitacoraController::class, 'index'])->name('bitacora.index');
        Route::post('bitacora/data', [BitacoraController::class, 'data'])->name('bitacora.data');
        Route::post('bitacora/sesiones/data', [BitacoraController::class, 'sessionsData'])->name('bitacora.sesiones.data');
        Route::post('bitacora/sesiones/{sesion}/invalidar', [BitacoraController::class, 'invalidateSession'])
            ->name('bitacora.sesiones.invalidar')
            ->where('sesion', '[a-zA-Z0-9]+');
        Route::get('bitacora/sesiones/{sesion}', [BitacoraController::class, 'showSesion'])
            ->name('bitacora.sesiones.show')
            ->where('sesion', '[a-zA-Z0-9]+');
        Route::get('bitacora/pdf', [BitacoraController::class, 'pdf'])->name('bitacora.pdf');
        Route::get('bitacora/{bitacora}', [BitacoraController::class, 'show'])->name('bitacora.show');

        Route::post('permisos/data', [PermissionController::class, 'data'])->name('permisos.data');
        Route::resource('permisos', PermissionController::class)
            ->parameters(['permisos' => 'permission'])
            ->except('show');
    });

    Route::prefix('revisiones')->name('revisiones.')->group(function () {
        Route::get('bandeja', [PeriodoRevisionController::class, 'bandeja'])->name('bandeja');
        Route::post('data', [PeriodoRevisionController::class, 'data'])->name('data');
        Route::post('{periodo}/importar-balanza', ImportBalanzaController::class)->name('importar-balanza');
        Route::post('{periodo}/conciliaciones', [ConciliacionController::class, 'store'])->name('conciliaciones.store');
        Route::delete('{periodo}/conciliaciones/{conciliacion}', [ConciliacionController::class, 'destroy'])->name('conciliaciones.destroy');
        Route::post('{periodo}/ajustes', [AjusteContableController::class, 'store'])->name('ajustes.store');
        Route::patch('{periodo}/ajustes/{ajuste}', [AjusteContableController::class, 'estado'])->name('ajustes.estado');
        Route::get('{periodo}/pdf', [PeriodoRevisionController::class, 'pdf'])->name('pdf');
        Route::post('{periodo}/flujo/{accion}', FlujoController::class)
            ->name('flujo')
            ->whereIn('accion', array_keys(RevisionBalanceFlujoService::ACCIONES));
    });

    Route::resource('revisiones', PeriodoRevisionController::class)
        ->parameters(['revisiones' => 'periodo'])
        ->except('destroy');
});
