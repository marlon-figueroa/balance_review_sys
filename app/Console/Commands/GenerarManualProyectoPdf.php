<?php

namespace App\Console\Commands;

use App\Services\ManualProyectoPdfService;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;

class GenerarManualProyectoPdf extends Command
{
    protected $signature = 'docs:manual-proyecto-pdf {--output= : Ruta del PDF (por defecto docs/manual/manual-sistema.pdf)}';

    protected $description = 'Genera el PDF descriptivo del sistema con diagramas Mermaid (tema neo)';

    public function handle(ManualProyectoPdfService $manual): int
    {
        $datos = $manual->datos();

        if ($datos['faltanDiagramas']) {
            $this->warn('Faltan PNG en docs/manual/png. Ejecute: npm run docs:diagrams');
        }

        $salida = $this->option('output') ?? base_path('docs/manual/manual-sistema.pdf');
        File::ensureDirectoryExists(dirname($salida));

        Pdf::loadView('pdf.manual-proyecto', $datos)
            ->setOption('isPhpEnabled', true)
            ->save($salida);

        $this->info("Manual generado: {$salida}");

        return self::SUCCESS;
    }
}
