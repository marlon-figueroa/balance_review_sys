<?php

namespace App\Http\Controllers\Revisiones;

use App\Http\Controllers\Controller;
use App\Http\Requests\Revisiones\PeriodoRevisionRequest;
use App\Models\CuentaContable;
use App\Models\PeriodoRevision;
use App\Services\RevisionBalanceDiagramaService;
use App\Services\RevisionBalanceFlujoService;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Yajra\DataTables\Facades\DataTables;

class PeriodoRevisionController extends Controller
{
    public function __construct()
    {
        $this->authorizeResource(PeriodoRevision::class, 'periodo');
    }

    public function index(): View
    {
        return view('revisiones.index');
    }

    public function bandeja(): View
    {
        $this->authorize('viewAny', PeriodoRevision::class);

        return view('revisiones.bandeja');
    }

    public function data(Request $request): JsonResponse
    {
        $this->authorize('viewAny', PeriodoRevision::class);

        $query = PeriodoRevision::query()->with('creador')->latest('anio')->latest('mes');

        if ($request->boolean('solo_revision')) {
            $query->where('estado', 'en_revision');
        }

        return DataTables::eloquent($query)
            ->addColumn('periodo', fn (PeriodoRevision $p) => $p->etiquetaPeriodo())
            ->editColumn('estado', fn (PeriodoRevision $p) => $p->estado->etiqueta())
            ->addColumn('creador', fn (PeriodoRevision $p) => $p->creador?->name ?? '—')
            ->editColumn('integridad_ok', fn (PeriodoRevision $p) => $p->integridad_ok
                ? '<span class="badge text-bg-success">OK</span>'
                : '<span class="badge text-bg-danger">Revisar</span>')
            ->addColumn('acciones', fn (PeriodoRevision $p) => view('revisiones.partials.acciones-listado', ['periodo' => $p])->render())
            ->rawColumns(['integridad_ok', 'acciones'])
            ->toJson();
    }

    public function create(): View
    {
        return view('revisiones.create', ['periodo' => new PeriodoRevision]);
    }

    public function store(PeriodoRevisionRequest $request): RedirectResponse
    {
        $periodo = PeriodoRevision::create([
            ...$request->validated(),
            'usuario_creador_id' => $request->user()->id,
        ]);

        $periodo->historial()->create([
            'usuario_id' => $request->user()->id,
            'accion' => 'crear',
            'estado_anterior' => null,
            'estado_nuevo' => $periodo->estado->value,
        ]);

        return redirect()->route('revisiones.show', $periodo)->with('success', 'Periodo creado.');
    }

    public function show(
        PeriodoRevision $periodo,
        RevisionBalanceFlujoService $flujo,
        RevisionBalanceDiagramaService $diagrama,
    ): View {
        $periodo->load(['lineasBalanza', 'conciliaciones', 'hallazgos', 'ajustes.usuario', 'historial.usuario', 'creador']);

        return view('revisiones.show', [
            'periodo' => $periodo,
            'accionesFlujo' => $flujo->accionesDisponibles($periodo, auth()->user()),
            'cuentasCatalogo' => CuentaContable::query()->activas()->ordenadas()->get(['codigo', 'nombre']),
            'diagrama' => $diagrama->diagrama($periodo),
        ]);
    }

    public function edit(PeriodoRevision $periodo): View
    {
        return view('revisiones.edit', compact('periodo'));
    }

    public function update(PeriodoRevisionRequest $request, PeriodoRevision $periodo): RedirectResponse
    {
        $periodo->update($request->validated());

        return redirect()->route('revisiones.show', $periodo)->with('success', 'Periodo actualizado.');
    }

    public function pdf(PeriodoRevision $periodo): \Illuminate\Http\Response
    {
        $this->authorize('reporte', $periodo);

        $periodo->load(['lineasBalanza', 'hallazgos', 'ajustes', 'creador', 'certificador']);

        return Pdf::loadView('revisiones.pdf', [
            'periodo' => $periodo,
            'generadoEn' => now(),
            'generadoPor' => auth()->user()->name,
        ])
            ->setOption('isPhpEnabled', true)
            ->download('revision_balance_'.str_replace('/', '-', $periodo->etiquetaPeriodo()).'.pdf');
    }
}
