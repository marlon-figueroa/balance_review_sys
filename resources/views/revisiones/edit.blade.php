@extends('layouts.app')

@section('title', 'Editar periodo')

@section('content')
    <x-page-header :title="'Editar '.$periodo->etiquetaPeriodo()" icon="pencil" />

    <div class="card">
        <div class="card-body">
            @include('revisiones.partials.form', ['periodo' => $periodo, 'action' => route('revisiones.update', $periodo), 'method' => 'PUT'])
        </div>
    </div>
@endsection
