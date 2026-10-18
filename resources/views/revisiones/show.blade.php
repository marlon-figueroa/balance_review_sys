@extends('layouts.app')

@section('title', 'Periodo '.$periodo->etiquetaPeriodo())

@section('content')
    <x-page-header :title="'Revisión '.$periodo->etiquetaPeriodo()" icon="journal-check" :subtitle="$periodo->estado->etiqueta()">
        @can('reporte', $periodo)
            <x-action-btn variant="export" icon="file-earmark-pdf" label="Reporte PDF" :href="route('revisiones.pdf', $periodo)" />
        @endcan
        @can('update', $periodo)
            <x-action-btn variant="edit" icon="pencil" label="Editar" :href="route('revisiones.edit', $periodo)" />
        @endcan
    </x-page-header>

    @include('partials.alerts')

    <div class="row g-3 mb-3">
        <div class="col-md-3"><div class="card"><div class="card-body small">Activo<strong class="d-block fs-5">{{ number_format((float) $periodo->total_activo, 2) }}</strong></div></div></div>
        <div class="col-md-3"><div class="card"><div class="card-body small">Pasivo<strong class="d-block fs-5">{{ number_format((float) $periodo->total_pasivo, 2) }}</strong></div></div></div>
        <div class="col-md-3"><div class="card"><div class="card-body small">Patrimonio<strong class="d-block fs-5">{{ number_format((float) $periodo->total_patrimonio, 2) }}</strong></div></div></div>
        <div class="col-md-3"><div class="card"><div class="card-body small">Integridad<strong class="d-block fs-5 {{ $periodo->integridad_ok ? 'text-success' : 'text-danger' }}">{{ $periodo->integridad_ok ? 'OK' : 'Incumplida' }}</strong></div></div></div>
    </div>

    @if ($accionesFlujo !== [])
        <div class="card mb-3">
            <div class="card-header">Flujo de aprobación</div>
            <div class="card-body d-flex flex-wrap gap-2">
                @foreach ($accionesFlujo as $accion)
                    <form method="POST" action="{{ route('revisiones.flujo', [$periodo, $accion]) }}" class="d-inline">
                        @csrf
                        @if ($accion === 'rechazar')
                            <div class="input-group input-group-sm">
                                <input type="text" name="comentario" class="form-control" placeholder="Motivo del rechazo" required>
                                <button class="btn btn-outline-danger">{{ \App\Services\RevisionBalanceFlujoService::ETIQUETAS[$accion] }}</button>
                            </div>
                        @else
                            <button class="btn btn-sm btn-primary">{{ \App\Services\RevisionBalanceFlujoService::ETIQUETAS[$accion] }}</button>
                        @endif
                    </form>
                @endforeach
            </div>
        </div>
    @endif

    <ul class="nav nav-tabs" role="tablist">
        <li class="nav-item"><button class="nav-link active" data-bs-toggle="tab" data-bs-target="#tab-balanza" type="button">Balanza</button></li>
        <li class="nav-item"><button class="nav-link" data-bs-toggle="tab" data-bs-target="#tab-conciliaciones" type="button">Conciliaciones</button></li>
        <li class="nav-item"><button class="nav-link" data-bs-toggle="tab" data-bs-target="#tab-hallazgos" type="button">Hallazgos</button></li>
        <li class="nav-item"><button class="nav-link" data-bs-toggle="tab" data-bs-target="#tab-ajustes" type="button">Ajustes</button></li>
        <li class="nav-item"><button class="nav-link" data-bs-toggle="tab" data-bs-target="#tab-kpis" type="button">KPIs</button></li>
        <li class="nav-item"><button class="nav-link" data-bs-toggle="tab" data-bs-target="#tab-historial" type="button">Historial</button></li>
    </ul>

    <div class="tab-content card border-top-0 rounded-top-0">
        <div class="tab-pane fade show active p-3" id="tab-balanza">
            @can('import', $periodo)
                <form method="POST" action="{{ route('revisiones.importar-balanza', $periodo) }}" enctype="multipart/form-data" class="row g-2 align-items-end mb-3">
                    @csrf
                    <div class="col-md-8">
                        <label class="form-label">Importar CSV de balanza</label>
                        <input type="file" name="archivo" class="form-control" accept=".csv,text/csv" required>
                    </div>
                    <div class="col-md-4">
                        <button class="btn btn-primary w-100">Importar</button>
                    </div>
                </form>
            @endcan
            <div class="table-responsive">
                <table class="table table-sm table-striped">
                    <thead><tr><th>Código</th><th>Nombre</th><th>Naturaleza</th><th>Debe</th><th>Haber</th><th>Saldo</th></tr></thead>
                    <tbody>
                        @forelse ($periodo->lineasBalanza as $linea)
                            <tr>
                                <td>{{ $linea->codigo_cuenta }}</td>
                                <td>{{ $linea->nombre }}</td>
                                <td>{{ $linea->naturaleza->etiqueta() }}</td>
                                <td>{{ number_format((float) $linea->debe, 2) }}</td>
                                <td>{{ number_format((float) $linea->haber, 2) }}</td>
                                <td>{{ number_format((float) $linea->saldo, 2) }}</td>
                            </tr>
                        @empty
                            <tr><td colspan="6" class="text-center text-body-secondary">Sin líneas. Importe un CSV.</td></tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        <div class="tab-pane fade p-3" id="tab-conciliaciones">
            @can('update', $periodo)
                <form method="POST" action="{{ route('revisiones.conciliaciones.store', $periodo) }}" class="row g-2 mb-3">
                    @csrf
                    <div class="col-md-2"><input name="tipo" class="form-control" placeholder="Tipo" required></div>
                    <div class="col-md-3"><input name="referencia" class="form-control" placeholder="Referencia" required></div>
                    <div class="col-md-2"><input name="saldo_contable" type="number" step="0.01" class="form-control" placeholder="Saldo contable" required></div>
                    <div class="col-md-2"><input name="saldo_externo" type="number" step="0.01" class="form-control" placeholder="Saldo externo" required></div>
                    <div class="col-md-2"><button class="btn btn-primary w-100">Agregar</button></div>
                </form>
            @endcan
            <table class="table table-sm">
                <thead><tr><th>Tipo</th><th>Referencia</th><th>Contable</th><th>Externo</th><th>Diferencia</th><th></th></tr></thead>
                <tbody>
                    @foreach ($periodo->conciliaciones as $c)
                        <tr>
                            <td>{{ $c->tipo }}</td>
                            <td>{{ $c->referencia }}</td>
                            <td>{{ number_format((float) $c->saldo_contable, 2) }}</td>
                            <td>{{ number_format((float) $c->saldo_externo, 2) }}</td>
                            <td>{{ number_format((float) $c->diferencia, 2) }}</td>
                            <td>
                                @can('update', $periodo)
                                    <form method="POST" action="{{ route('revisiones.conciliaciones.destroy', [$periodo, $c]) }}" class="d-inline">@csrf @method('DELETE')<button class="btn btn-sm btn-outline-danger">&times;</button></form>
                                @endcan
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <div class="tab-pane fade p-3" id="tab-hallazgos">
            @foreach ($periodo->hallazgos as $h)
                <div class="alert alert-{{ $h->severidad->value === 'critico' ? 'danger' : ($h->severidad->value === 'advertencia' ? 'warning' : 'info') }} py-2">
                    <strong>{{ $h->titulo }}</strong> — {{ $h->descripcion }}
                </div>
            @endforeach
            @if ($periodo->hallazgos->isEmpty())
                <p class="text-body-secondary mb-0">No hay hallazgos registrados.</p>
            @endif
        </div>

        <div class="tab-pane fade p-3" id="tab-ajustes">
            @can('update', $periodo)
                <form method="POST" action="{{ route('revisiones.ajustes.store', $periodo) }}" class="row g-2 mb-3">
                    @csrf
                    <div class="col-md-2"><input name="codigo_cuenta" class="form-control" placeholder="Cuenta" required></div>
                    <div class="col-md-2"><input name="monto" type="number" step="0.01" class="form-control" placeholder="Monto" required></div>
                    <div class="col-md-5"><input name="descripcion" class="form-control" placeholder="Descripción" required></div>
                    <div class="col-md-2"><button class="btn btn-primary w-100">Proponer</button></div>
                </form>
            @endcan
            <table class="table table-sm">
                <thead><tr><th>Cuenta</th><th>Monto</th><th>Estado</th><th>Propuesto por</th><th></th></tr></thead>
                <tbody>
                    @foreach ($periodo->ajustes as $ajuste)
                        <tr>
                            <td>{{ $ajuste->codigo_cuenta }}</td>
                            <td>{{ number_format((float) $ajuste->monto, 2) }}</td>
                            <td>{{ $ajuste->estado }}</td>
                            <td>{{ $ajuste->usuario?->name }}</td>
                            <td>
                                @can('flujo', $periodo)
                                    @if ($ajuste->estado === 'propuesto')
                                        <form method="POST" action="{{ route('revisiones.ajustes.estado', [$periodo, $ajuste]) }}" class="d-inline">@csrf @method('PATCH')<input type="hidden" name="estado" value="aprobado"><button class="btn btn-sm btn-success">Aprobar</button></form>
                                        <form method="POST" action="{{ route('revisiones.ajustes.estado', [$periodo, $ajuste]) }}" class="d-inline">@csrf @method('PATCH')<input type="hidden" name="estado" value="rechazado"><button class="btn btn-sm btn-outline-danger">Rechazar</button></form>
                                    @endif
                                @endcan
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <div class="tab-pane fade p-3" id="tab-kpis">
            @php $kpis = $periodo->kpis ?? []; @endphp
            <ul class="list-unstyled mb-0">
                <li>Liquidez corriente: <strong>{{ $kpis['liquidez_corriente'] ?? '—' }}</strong></li>
                <li>Endeudamiento: <strong>{{ $kpis['endeudamiento'] ?? '—' }}</strong></li>
                <li>Capital de trabajo: <strong>{{ isset($kpis['capital_trabajo']) ? number_format($kpis['capital_trabajo'], 2) : '—' }}</strong></li>
            </ul>
            @if (! empty($kpis['alertas']))
                <p class="mt-2 text-danger small mb-0">Alertas: {{ implode(', ', $kpis['alertas']) }}</p>
            @endif
        </div>

        <div class="tab-pane fade p-3" id="tab-historial">
            <ul class="list-group list-group-flush">
                @foreach ($periodo->historial as $evento)
                    <li class="list-group-item small">
                        {{ $evento->created_at?->format('d/m/Y H:i') }} — {{ $evento->usuario?->name }}: {{ $evento->accion }}
                        ({{ $evento->estado_anterior ?? '—' }} → {{ $evento->estado_nuevo }})
                        @if ($evento->comentario)<br><em>{{ $evento->comentario }}</em>@endif
                    </li>
                @endforeach
            </ul>
        </div>
    </div>
@endsection
