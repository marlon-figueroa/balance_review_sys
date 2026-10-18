<?php

namespace App\Http\Requests\Revisiones;

use Illuminate\Foundation\Http\FormRequest;

class AjusteContableRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'hallazgo_id' => ['nullable', 'exists:hallazgos,id'],
            'codigo_cuenta' => ['required', 'string', 'max:32'],
            'monto' => ['required', 'numeric', 'not_in:0'],
            'descripcion' => ['required', 'string', 'max:500'],
        ];
    }
}
