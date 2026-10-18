<?php

namespace App\Http\Controllers;

use App\Services\ManualProyectoPdfService;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Response;

class ManualProyectoController extends Controller
{
    public function __invoke(ManualProyectoPdfService $manual): Response
    {
        $this->authorize('viewAny', \App\Models\PeriodoRevision::class);

        return Pdf::loadView('pdf.manual-proyecto', $manual->datos())
            ->setOption('isPhpEnabled', true)
            ->download('manual_sistema_revision_balance.pdf');
    }
}
