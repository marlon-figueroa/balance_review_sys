<form method="POST" action="{{ $action }}">
    @csrf
    @if ($method !== 'POST')
        @method($method)
    @endif

    <div class="row g-3">
        <div class="col-md-6">
            <label for="anio" class="form-label">Año</label>
            <input type="number" name="anio" id="anio" class="form-control @error('anio') is-invalid @enderror" value="{{ old('anio', $periodo->anio ?? now()->year) }}" required>
            @error('anio')<div class="invalid-feedback">{{ $message }}</div>@enderror
        </div>
        <div class="col-md-6">
            <label for="mes" class="form-label">Mes</label>
            <input type="number" name="mes" id="mes" min="1" max="12" class="form-control @error('mes') is-invalid @enderror" value="{{ old('mes', $periodo->mes ?? now()->month) }}" required>
            @error('mes')<div class="invalid-feedback">{{ $message }}</div>@enderror
        </div>
    </div>

    <div class="mt-4 d-flex gap-2">
        <button type="submit" class="btn btn-primary">Guardar</button>
        <a href="{{ route('revisiones.index') }}" class="btn btn-outline-secondary">Cancelar</a>
    </div>
</form>
