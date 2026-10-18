<?php

namespace App\Http\Controllers\Revisiones;

use App\Http\Controllers\Controller;
use App\Models\PeriodoRevision;
use App\Services\RevisionBalanceCatalogoService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class CargarCatalogoBalanzaController extends Controller
{
    public function __invoke(Request $request, PeriodoRevision $periodo, RevisionBalanceCatalogoService $catalogo): RedirectResponse
    {
        $this->authorize('import', $periodo);

        $modo = $request->validate([
            'modo' => ['required', 'in:estructura,demo'],
        ])['modo'];

        $filas = $modo === 'demo'
            ? $catalogo->cargarDemostrativoEquilibrado($periodo)
            : $catalogo->cargarEstructuraCatalogo($periodo);

        $mensaje = $modo === 'demo'
            ? "Se cargó la balanza demostrativa equilibrada ({$filas} cuentas con movimiento)."
            : "Se cargó la estructura del catálogo ({$filas} cuentas, saldos en cero).";

        return back()->with('success', $mensaje);
    }
}
