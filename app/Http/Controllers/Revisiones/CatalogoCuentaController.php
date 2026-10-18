<?php

namespace App\Http\Controllers\Revisiones;

use App\Http\Controllers\Controller;
use App\Http\Requests\Revisiones\CuentaContableRequest;
use App\Models\CuentaContable;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;
use Yajra\DataTables\Facades\DataTables;

class CatalogoCuentaController extends Controller
{
    public function __construct()
    {
        $this->authorizeResource(CuentaContable::class, 'cuenta');
    }

    public function index(): View
    {
        return view('revisiones.catalogo.index');
    }

    public function data(): JsonResponse
    {
        $this->authorize('viewAny', CuentaContable::class);

        $query = CuentaContable::query()->select('cuentas_contables.*');

        return DataTables::eloquent($query)
            ->editColumn('naturaleza', fn (CuentaContable $c) => $c->naturaleza->etiqueta())
            ->editColumn('es_corriente', fn (CuentaContable $c) => $c->es_corriente
                ? '<span class="badge text-bg-info">Corriente</span>'
                : '<span class="badge text-bg-secondary">No corriente</span>')
            ->editColumn('activa', fn (CuentaContable $c) => $c->activa
                ? '<span class="badge text-bg-success">Activa</span>'
                : '<span class="badge text-bg-secondary">Inactiva</span>')
            ->addColumn('acciones', fn (CuentaContable $c) => view('revisiones.catalogo.partials.acciones', ['cuenta' => $c])->render())
            ->rawColumns(['es_corriente', 'activa', 'acciones'])
            ->toJson();
    }

    public function create(): View
    {
        return view('revisiones.catalogo.create', ['cuenta' => new CuentaContable(['activa' => true])]);
    }

    public function store(CuentaContableRequest $request): RedirectResponse
    {
        CuentaContable::create($request->validated());

        return redirect()->route('revisiones.catalogo.index')->with('success', 'Cuenta agregada al catálogo.');
    }

    public function edit(CuentaContable $cuenta): View
    {
        return view('revisiones.catalogo.edit', compact('cuenta'));
    }

    public function update(CuentaContableRequest $request, CuentaContable $cuenta): RedirectResponse
    {
        $cuenta->update($request->validated());

        return redirect()->route('revisiones.catalogo.index')->with('success', 'Cuenta actualizada.');
    }

    public function destroy(CuentaContable $cuenta): JsonResponse
    {
        $cuenta->delete();

        return response()->json(['message' => 'Cuenta eliminada del catálogo.']);
    }
}
