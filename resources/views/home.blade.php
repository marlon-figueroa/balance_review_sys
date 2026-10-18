@extends('layouts.app')

@section('title', 'Inicio')

@section('content')
    <x-page-header
        :title="__('Dashboard')"
        icon="speedometer2"
        :subtitle="now()->translatedFormat('l \d\e F \d\e Y')"
        :section="null"
    />

    <div class="dashboard-compact">
        <p class="mb-3 small text-body-secondary">
            Bienvenido(a), <strong class="text-body-emphasis">{{ Auth::user()->name }}</strong>.
        </p>

        @can('revisiones.ver')
            <section class="dashboard-section mb-4" aria-labelledby="dashboard-revisiones-titulo">
                <div class="d-flex flex-wrap align-items-center justify-content-between gap-2 mb-2">
                    <h2 class="dashboard-section__title mb-0" id="dashboard-revisiones-titulo">
                        <i class="bi bi-journal-check me-1" aria-hidden="true"></i>
                        Revisión de balance
                    </h2>
                    <a href="{{ route('revisiones.index') }}" class="small text-decoration-none">
                        Ver periodos <i class="bi bi-arrow-right"></i>
                    </a>
                </div>
                <div class="card">
                    <div class="card-body py-3">
                        <div class="row g-2 row-cols-2 row-cols-md-4">
                            @include('home._kpi', ['label' => 'Abiertos', 'value' => $revisiones['periodos_abiertos']])
                            @include('home._kpi', ['label' => 'En revisión', 'value' => $revisiones['en_revision'], 'valueClass' => 'text-warning'])
                            @include('home._kpi', ['label' => 'Hallazgos críticos', 'value' => $revisiones['hallazgos_criticos'], 'valueClass' => 'text-danger'])
                            @include('home._kpi', [
                                'label' => 'Último certificado',
                                'value' => $revisiones['ultimo_certificado']?->etiquetaPeriodo() ?? '—',
                            ])
                        </div>
                        @if (! empty($revisiones['kpis_ultimo']))
                            <hr class="my-3">
                            <p class="small text-body-secondary mb-2">KPIs del último periodo certificado</p>
                            <div class="row g-2 small">
                                <div class="col-md-4">Liquidez: <strong>{{ $revisiones['kpis_ultimo']['liquidez_corriente'] ?? '—' }}</strong></div>
                                <div class="col-md-4">Endeudamiento: <strong>{{ $revisiones['kpis_ultimo']['endeudamiento'] ?? '—' }}</strong></div>
                                <div class="col-md-4">Capital de trabajo: <strong>{{ number_format($revisiones['kpis_ultimo']['capital_trabajo'] ?? 0, 2) }}</strong></div>
                            </div>
                        @endif
                    </div>
                </div>
            </section>
        @endcan

        @if (count($statsAdmin) > 0)
            <section class="dashboard-section" aria-labelledby="dashboard-admin-titulo">
                <h2 class="dashboard-section__title mb-2" id="dashboard-admin-titulo">
                    <i class="bi bi-gear me-1"></i> Administración
                </h2>
                <div class="row g-3">
                    @foreach ($statsAdmin as $stat)
                        <div class="col-md-4">
                            <a href="{{ $stat['route'] }}" class="text-decoration-none">
                                <div class="card h-100 border-{{ $stat['color'] }}">
                                    <div class="card-body d-flex align-items-center gap-3">
                                        <i class="bi bi-{{ $stat['icon'] }} fs-3 text-{{ $stat['color'] }}"></i>
                                        <div>
                                            <div class="small text-body-secondary">{{ $stat['label'] }}</div>
                                            <div class="fs-4 fw-semibold">{{ $stat['total'] }}</div>
                                        </div>
                                    </div>
                                </div>
                            </a>
                        </div>
                    @endforeach
                </div>
            </section>
        @endif
    </div>
@endsection
