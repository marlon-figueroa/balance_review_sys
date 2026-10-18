<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Spatie\Permission\PermissionRegistrar;

class RolesAndPermissionsSeeder extends Seeder
{
    private const PERMISOS = [
        'usuarios' => ['ver', 'crear', 'editar', 'eliminar', 'exportar'],
        'roles' => ['ver', 'crear', 'editar', 'eliminar'],
        'permisos' => ['ver', 'crear', 'editar', 'eliminar'],
        'bitacora' => ['ver', 'exportar', 'invalidar_sesion'],
        'monitoreo' => ['pulse', 'logs'],
        'revisiones' => ['ver', 'crear', 'editar', 'enviar', 'revisar', 'aprobar', 'certificar', 'reportes'],
    ];

    public function run(): void
    {
        app(PermissionRegistrar::class)->forgetCachedPermissions();

        $permisos = collect(self::PERMISOS)
            ->flatMap(fn (array $acciones, string $modulo) => array_map(fn ($accion) => "{$modulo}.{$accion}", $acciones))
            ->map(fn (string $nombre) => Permission::findOrCreate($nombre, 'web'));

        Role::findOrCreate('Administrador', 'web')->syncPermissions($permisos);

        Role::findOrCreate('Registrador', 'web')->syncPermissions([
            'revisiones.ver',
            'revisiones.crear',
            'revisiones.editar',
            'revisiones.enviar',
        ]);

        Role::findOrCreate('Revisor', 'web')->syncPermissions([
            'revisiones.ver',
            'revisiones.revisar',
            'revisiones.aprobar',
        ]);

        Role::findOrCreate('Aprobador', 'web')->syncPermissions([
            'revisiones.ver',
            'revisiones.aprobar',
            'revisiones.certificar',
        ]);

        Role::findOrCreate('Gerencia', 'web')->syncPermissions([
            'revisiones.ver',
            'revisiones.reportes',
        ]);

        app(PermissionRegistrar::class)->forgetCachedPermissions();
    }
}
