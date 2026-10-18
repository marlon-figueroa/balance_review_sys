<?php

namespace App\Http\Requests\Revisiones;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class AjusteContableRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        $codigoRules = ['required', 'string', 'max:32'];
        if (config('balance_review.validar_catalogo')) {
            $codigoRules[] = Rule::exists('cuentas_contables', 'codigo')->where('activa', true);
        }

        return [
            'hallazgo_id' => ['nullable', 'exists:hallazgos,id'],
            'codigo_cuenta' => $codigoRules,
            'monto' => ['required', 'numeric', 'not_in:0'],
            'descripcion' => ['required', 'string', 'max:500'],
        ];
    }
}
