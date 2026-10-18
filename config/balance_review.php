<?php

return [
    'validar_catalogo' => (bool) env('BALANCE_VALIDAR_CATALOGO', true),
    'enriquecer_import_desde_catalogo' => (bool) env('BALANCE_ENRIQUECER_IMPORT_CATALOGO', true),
    'saldo_material' => 1000,
    'variacion_porcentaje_alerta' => 25,
    'prefijos' => [
        'activo_corriente' => ['11'],
        'pasivo_corriente' => ['21'],
        'activo' => ['1'],
        'pasivo' => ['2'],
        'patrimonio' => ['3'],
    ],
    'umbrales_kpi' => [
        'liquidez_minima' => 1.0,
        'endeudamiento_maximo' => 0.7,
    ],
];
