@extends('layouts.app')

@section('title', 'Editar periodo')

@section('content')
    <x-page-header
        :title="'Editar '.$periodo->etiquetaPeriodo()"
        icon="pencil-square"
        section="Revisión de balance"
        :parent="['url' => route('revisiones.index'), 'label' => 'Listado']"
    >
        <x-page-action-group label="Navegación">
            <x-action-btn variant="nav" icon="arrow-left" label="Volver al listado" :href="route('revisiones.index')" />
            <x-action-btn variant="nav" icon="eye" label="Ver detalle" :href="route('revisiones.show', $periodo)" />
        </x-page-action-group>
    </x-page-header>

    <div class="card">
        <div class="card-body">
            @include('revisiones.partials.form', ['periodo' => $periodo, 'action' => route('revisiones.update', $periodo), 'method' => 'PUT'])
        </div>
    </div>
@endsection
