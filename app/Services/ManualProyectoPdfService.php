<?php

namespace App\Services;

use Illuminate\Support\Facades\File;

class ManualProyectoPdfService
{
    private const DIAGRAMAS = [
        'flujo_estados' => 'flujo-estados.png',
        'arquitectura' => 'arquitectura.png',
        'proceso_periodo' => 'proceso-periodo.png',
        'roles' => 'roles.png',
        'despliegue' => 'despliegue.png',
    ];

    /**
     * @return array<string, mixed>
     */
    public function datos(): array
    {
        $pngDir = base_path('docs/manual/png');
        $diagramas = [];

        foreach (self::DIAGRAMAS as $clave => $archivo) {
            $ruta = $pngDir.'/'.$archivo;
            $diagramas[$clave] = File::exists($ruta)
                ? 'data:image/png;base64,'.base64_encode(File::get($ruta))
                : null;
        }

        return [
            'generadoEn' => now(),
            'diagramas' => $diagramas,
            'faltanDiagramas' => in_array(null, $diagramas, true),
            'rutaDiagramas' => $pngDir,
        ];
    }
}
