@csrf

<div class="row g-3">
    <div class="col-md-3">
        <label for="codigo" class="form-label">Código <span class="text-danger">*</span></label>
        <input type="text" id="codigo" name="codigo" value="{{ old('codigo', $cuenta->codigo) }}"
               class="form-control @error('codigo') is-invalid @enderror" required maxlength="32" pattern="[0-9]+"
               @disabled($cuenta->exists)>
        @error('codigo')<div class="invalid-feedback">{{ $message }}</div>@enderror
        <div class="form-text">Solo dígitos; alineado a prefijos de KPI (11 activo, 21 pasivo, 31 patrimonio).</div>
    </div>
    <div class="col-md-5">
        <label for="nombre" class="form-label">Nombre <span class="text-danger">*</span></label>
        <input type="text" id="nombre" name="nombre" value="{{ old('nombre', $cuenta->nombre) }}"
               class="form-control @error('nombre') is-invalid @enderror" required maxlength="255">
        @error('nombre')<div class="invalid-feedback">{{ $message }}</div>@enderror
    </div>
    <div class="col-md-4">
        <label for="naturaleza" class="form-label">Naturaleza <span class="text-danger">*</span></label>
        <select id="naturaleza" name="naturaleza" class="form-select @error('naturaleza') is-invalid @enderror" required>
            @foreach (\App\Enums\NaturalezaCuenta::cases() as $opcion)
                <option value="{{ $opcion->value }}" @selected(old('naturaleza', $cuenta->naturaleza?->value) === $opcion->value)>{{ $opcion->etiqueta() }}</option>
            @endforeach
        </select>
        @error('naturaleza')<div class="invalid-feedback">{{ $message }}</div>@enderror
    </div>
    <div class="col-md-3">
        <label for="orden" class="form-label">Orden</label>
        <input type="number" id="orden" name="orden" value="{{ old('orden', $cuenta->orden ?? 0) }}" min="0" max="9999"
               class="form-control @error('orden') is-invalid @enderror">
        @error('orden')<div class="invalid-feedback">{{ $message }}</div>@enderror
    </div>
    <div class="col-md-9">
        <label for="descripcion" class="form-label">Descripción</label>
        <textarea id="descripcion" name="descripcion" rows="2" maxlength="2000"
                  class="form-control @error('descripcion') is-invalid @enderror">{{ old('descripcion', $cuenta->descripcion) }}</textarea>
        @error('descripcion')<div class="invalid-feedback">{{ $message }}</div>@enderror
    </div>
    <div class="col-md-6">
        <div class="form-check form-switch">
            <input class="form-check-input" type="checkbox" id="es_corriente" name="es_corriente" value="1"
                   @checked(old('es_corriente', $cuenta->es_corriente))>
            <label class="form-check-label" for="es_corriente">Cuenta corriente (liquidez / capital de trabajo)</label>
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-check form-switch">
            <input class="form-check-input" type="checkbox" id="activa" name="activa" value="1"
                   @checked(old('activa', $cuenta->activa ?? true))>
            <label class="form-check-label" for="activa">Activa en catálogo</label>
        </div>
    </div>
</div>

<div class="d-flex justify-content-end gap-2 mt-4">
    <a href="{{ route('revisiones.catalogo.index') }}" class="btn btn-outline-secondary">
        <i class="bi bi-arrow-left"></i> {{ __('Cancel') }}
    </a>
    <button type="submit" class="btn btn-primary">
        <i class="bi bi-check-lg"></i> {{ __('Save') }}
    </button>
</div>
