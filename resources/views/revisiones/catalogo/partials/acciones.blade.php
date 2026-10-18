@can('update', $cuenta)
    <a href="{{ route('revisiones.catalogo.edit', $cuenta) }}" class="btn btn-sm btn-outline-primary" title="Editar">
        <i class="bi bi-pencil"></i>
    </a>
@endcan
@can('delete', $cuenta)
    <x-delete-button :url="route('revisiones.catalogo.destroy', $cuenta)" class="btn btn-sm btn-outline-danger" />
@endcan
