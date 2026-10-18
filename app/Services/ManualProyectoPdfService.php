<?php

namespace App\Services;

use Illuminate\Support\Facades\File;

class ManualProyectoPdfService
{
    private const DIAGRAMAS = [
        'flujo_estados' => 'flujo-estados.svg',
        'arquitectura' => 'arquitectura.svg',
        'proceso_periodo' => 'proceso-periodo.svg',
        'roles' => 'roles.svg',
        'despliegue' => 'despliegue.svg',
    ];

    /**
     * @return array<string, mixed>
     */
    public function datos(): array
    {
        $svgDir = base_path('docs/manual/svg');
        $diagramas = [];

        foreach (self::DIAGRAMAS as $clave => $archivo) {
            $ruta = $svgDir.'/'.$archivo;
            $diagramas[$clave] = File::exists($ruta)
                ? $this->normalizarSvg(File::get($ruta))
                : null;
        }

        return [
            'generadoEn' => now(),
            'diagramas' => $diagramas,
            'faltanDiagramas' => in_array(null, $diagramas, true),
            'rutaDiagramas' => $svgDir,
        ];
    }

    private function normalizarSvg(string $svg): string
    {
        return preg_replace('/<\?xml.*?\?>\s*/s', '', $svg) ?? $svg;
    }
}
