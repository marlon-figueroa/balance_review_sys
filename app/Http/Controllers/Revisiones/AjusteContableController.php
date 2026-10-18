<?php

namespace App\Http\Controllers\Revisiones;

use App\Http\Controllers\Controller;
use App\Http\Requests\Revisiones\AjusteContableRequest;
use App\Models\AjusteContable;
use App\Models\PeriodoRevision;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class AjusteContableController extends Controller
{
    public function store(AjusteContableRequest $request, PeriodoRevision $periodo): RedirectResponse
    {
        $this->authorize('update', $periodo);

        $periodo->ajustes()->create([
            ...$request->validated(),
            'usuario_id' => $request->user()->id,
            'estado' => 'propuesto',
        ]);

        return back()->with('success', 'Ajuste propuesto.');
    }

    public function estado(Request $request, PeriodoRevision $periodo, AjusteContable $ajuste): RedirectResponse
    {
        $this->authorize('flujo', $periodo);
        abort_unless($ajuste->periodo_revision_id === $periodo->id, 404);

        $request->validate(['estado' => ['required', 'in:aprobado,rechazado']]);

        if ($request->user()->id === $ajuste->usuario_id && $request->input('estado') === 'aprobado') {
            return back()->withErrors(['estado' => 'No puede aprobar su propio ajuste.']);
        }

        $ajuste->update(['estado' => $request->input('estado')]);

        return back()->with('success', 'Estado del ajuste actualizado.');
    }
}
