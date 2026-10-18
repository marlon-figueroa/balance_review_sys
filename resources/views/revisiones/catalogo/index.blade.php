@extends('layouts.app')

@section('title', 'Catálogo de cuentas')

@section('content')
    <x-page-header title="Catálogo de cuentas" icon="journal-text" subtitle="Plan de cuentas maestro para alimentar la balanza de comprobación.">
        @can('viewAny', \App\Models\CuentaContable::class)
            <x-page-action-group label="Exportar">
                <x-action-btn variant="export" icon="download" label="Plantilla CSV (ceros)" :href="route('revisiones.catalogo.exportar-csv')" />
                <x-action-btn variant="export" icon="file-earmark-spreadsheet" label="CSV demostrativo" :href="route('revisiones.catalogo.exportar-csv', ['demo' => 1])" />
            </x-page-action-group>
        @endcan
        @can('create', \App\Models\CuentaContable::class)
            <x-page-action-group label="Alta">
                <x-action-btn variant="create" icon="plus-lg" label="Nueva cuenta" :href="route('revisiones.catalogo.create')" />
            </x-page-action-group>
        @endcan
    </x-page-header>

    @include('partials.alerts')

    <div class="card">
        <div class="card-body">
            <p class="text-body-secondary small mb-3">
                Desde el detalle de un periodo en borrador puede cargar esta estructura a la balanza o importar un CSV generado desde aquí.
            </p>
            <table id="tabla-catalogo-cuentas" class="table table-striped w-100" data-url="{{ route('revisiones.catalogo.data') }}">
                <thead>
                    <tr>
                        <th>Código</th>
                        <th>Nombre</th>
                        <th>Naturaleza</th>
                        <th>Clasificación</th>
                        <th>Estado</th>
                        <th class="text-end">Acciones</th>
                    </tr>
                </thead>
            </table>
        </div>
    </div>
@endsection

@push('scripts')
    @vite('resources/js/pages/catalogo-cuentas.js')
@endpush
