<?php

namespace App\Http\Controllers\Revisiones;

use App\Http\Controllers\Controller;
use App\Models\PeriodoRevision;
use App\Services\RevisionBalanceFlujoService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class FlujoController extends Controller
{
    public function __invoke(
        Request $request,
        PeriodoRevision $periodo,
        string $accion,
        RevisionBalanceFlujoService $flujo,
    ): RedirectResponse {
        $this->authorize('flujo', $periodo);

        $flujo->ejecutar($periodo, $request->user(), $accion, $request->input('comentario'));

        return back()->with('success', RevisionBalanceFlujoService::ETIQUETAS[$accion] ?? 'Acción registrada.');
    }
}
