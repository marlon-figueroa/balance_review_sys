<?php

return [
    [
        'label' => 'Inicio',
        'icon' => 'home',
        'route' => 'home',
    ],
    [
        'label' => 'Mi perfil',
        'icon' => 'user',
        'route' => 'perfil.show',
    ],
    [
        'label' => 'Revisión de balance',
        'icon' => 'clipboard',
        'children' => [
            ['label' => 'Listado', 'icon' => 'list', 'route' => 'revisiones.index', 'active' => ['revisiones.index', 'revisiones.create', 'revisiones.show', 'revisiones.edit'], 'can' => 'revisiones.ver'],
            ['label' => 'Nueva revisión', 'icon' => 'plus-circle', 'route' => 'revisiones.create', 'can' => 'revisiones.crear'],
            ['label' => 'Bandeja revisor', 'icon' => 'inbox', 'route' => 'revisiones.bandeja', 'can' => 'revisiones.revisar'],
            ['label' => 'Catálogo de cuentas', 'icon' => 'journal-text', 'route' => 'revisiones.catalogo.index', 'can' => 'catalogo.ver'],
        ],
    ],
    [
        'label' => 'Administración',
        'icon' => 'settings',
        'children' => [
            [
                'label' => 'Seguridad',
                'icon' => 'lock',
                'children' => [
                    ['label' => 'Usuarios', 'icon' => 'users', 'route' => 'admin.usuarios.index', 'active' => 'admin.usuarios.*', 'can' => 'usuarios.ver'],
                    ['label' => 'Roles', 'icon' => 'shield', 'route' => 'admin.roles.index', 'active' => 'admin.roles.*', 'can' => 'roles.ver'],
                    ['label' => 'Permisos', 'icon' => 'key', 'route' => 'admin.permisos.index', 'active' => 'admin.permisos.*', 'can' => 'permisos.ver'],
                ],
            ],
            [
                'label' => 'Auditoría',
                'icon' => 'eye',
                'children' => [
                    ['label' => 'Bitácora', 'icon' => 'book-open', 'route' => 'admin.bitacora.index', 'active' => 'admin.bitacora.*', 'can' => ['bitacora.ver', 'monitoreo.pulse', 'monitoreo.logs']],
                ],
            ],
        ],
    ],
];
