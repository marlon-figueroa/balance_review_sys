@extends('layouts.app')

@section('title', 'Nueva cuenta contable')

@section('content')
    <x-page-header title="Nueva cuenta contable" icon="plus-circle"
                   :parent="['url' => route('revisiones.catalogo.index'), 'label' => 'Catálogo de cuentas']" />

    <div class="card">
        <div class="card-body">
            <form method="POST" action="{{ route('revisiones.catalogo.store') }}" autocomplete="off">
                @include('revisiones.catalogo._form')
            </form>
        </div>
    </div>
@endsection
