<?php

namespace App\Http\Controllers\Revisiones;

use App\Http\Controllers\Controller;
use App\Http\Requests\Revisiones\ConciliacionRequest;
use App\Models\Conciliacion;
use App\Models\PeriodoRevision;
use App\Services\RevisionBalanceProcesoService;
use Illuminate\Http\RedirectResponse;

class ConciliacionController extends Controller
{
    public function store(
        ConciliacionRequest $request,
        PeriodoRevision $periodo,
        RevisionBalanceProcesoService $proceso,
    ): RedirectResponse {
        $this->authorize('update', $periodo);

        $periodo->conciliaciones()->create($request->validated());
        $proceso->ejecutar($periodo->fresh(['lineasBalanza', 'conciliaciones']));

        return back()->with('success', 'Conciliación registrada.');
    }

    public function destroy(PeriodoRevision $periodo, Conciliacion $conciliacion, RevisionBalanceProcesoService $proceso): RedirectResponse
    {
        $this->authorize('update', $periodo);
        abort_unless($conciliacion->periodo_revision_id === $periodo->id, 404);

        $conciliacion->delete();
        $proceso->ejecutar($periodo->fresh(['lineasBalanza', 'conciliaciones']));

        return back()->with('success', 'Conciliación eliminada.');
    }
}
