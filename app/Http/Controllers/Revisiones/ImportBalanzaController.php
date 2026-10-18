<?php

namespace App\Http\Controllers\Revisiones;

use App\Http\Controllers\Controller;
use App\Models\PeriodoRevision;
use App\Services\RevisionBalanceImportService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class ImportBalanzaController extends Controller
{
    public function __invoke(Request $request, PeriodoRevision $periodo, RevisionBalanceImportService $import): RedirectResponse
    {
        $this->authorize('import', $periodo);

        $request->validate([
            'archivo' => ['required', 'file', 'mimes:csv,txt', 'max:2048'],
        ]);

        $filas = $import->importarCsv($periodo, $request->file('archivo'));

        return back()->with('success', "Se importaron {$filas} líneas de balanza.");
    }
}
