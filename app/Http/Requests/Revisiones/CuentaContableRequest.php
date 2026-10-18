<?php

namespace App\Http\Requests\Revisiones;

use App\Enums\NaturalezaCuenta;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class CuentaContableRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        $cuenta = $this->route('cuenta');

        return [
            'codigo' => [
                'required',
                'string',
                'max:32',
                'regex:/^[0-9]+$/',
                Rule::unique('cuentas_contables', 'codigo')->ignore($cuenta?->id),
            ],
            'nombre' => ['required', 'string', 'max:255'],
            'naturaleza' => ['required', Rule::enum(NaturalezaCuenta::class)],
            'es_corriente' => ['sometimes', 'boolean'],
            'activa' => ['sometimes', 'boolean'],
            'orden' => ['nullable', 'integer', 'min:0', 'max:9999'],
            'descripcion' => ['nullable', 'string', 'max:2000'],
        ];
    }

    protected function prepareForValidation(): void
    {
        $this->merge([
            'es_corriente' => $this->boolean('es_corriente'),
            'activa' => $this->boolean('activa', true),
        ]);
    }
}
