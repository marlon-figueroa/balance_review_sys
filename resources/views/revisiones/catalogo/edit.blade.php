@extends('layouts.app')

@section('title', 'Editar cuenta '.$cuenta->codigo)

@section('content')
    <x-page-header :title="'Editar '.$cuenta->codigo" icon="pencil"
                   :parent="['url' => route('revisiones.catalogo.index'), 'label' => 'Catálogo de cuentas']" />

    <div class="card">
        <div class="card-body">
            <form method="POST" action="{{ route('revisiones.catalogo.update', $cuenta) }}" autocomplete="off">
                @method('PUT')
                @include('revisiones.catalogo._form')
            </form>
        </div>
    </div>
@endsection
