@extends('layouts.app')

@section('title', 'Revisiones de balance')

@section('content')
    <x-page-header title="Revisiones de balance" icon="journal-check" subtitle="Periodos contables en revisión.">
        @can('create', \App\Models\PeriodoRevision::class)
            <x-action-btn variant="create" icon="plus-lg" label="Nueva revisión" :href="route('revisiones.create')" />
        @endcan
    </x-page-header>

    <div class="card">
        <div class="card-body">
            <table id="tabla-revisiones" class="table table-striped w-100" data-url="{{ route('revisiones.data') }}">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Periodo</th>
                        <th>Estado</th>
                        <th>Creador</th>
                        <th>Integridad</th>
                        <th class="text-end">Acciones</th>
                    </tr>
                </thead>
            </table>
        </div>
    </div>
@endsection

@push('scripts')
    @vite('resources/js/pages/revisiones-index.js')
@endpush
