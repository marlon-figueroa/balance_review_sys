@extends('layouts.app')

@section('title', 'Bandeja revisor')

@section('content')
    <x-page-header title="Bandeja revisor" icon="inbox" subtitle="Periodos en revisión pendientes de aprobación." />

    <div class="card">
        <div class="card-body">
            <table id="tabla-revisiones" class="table table-striped w-100" data-url="{{ route('revisiones.data') }}?solo_revision=1">
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
