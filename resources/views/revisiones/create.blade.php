@extends('layouts.app')

@section('title', 'Nueva revisión')

@section('content')
    <x-page-header title="Nueva revisión" icon="plus-circle" />

    <div class="card">
        <div class="card-body">
            @include('revisiones.partials.form', ['periodo' => $periodo, 'action' => route('revisiones.store'), 'method' => 'POST'])
        </div>
    </div>
@endsection
