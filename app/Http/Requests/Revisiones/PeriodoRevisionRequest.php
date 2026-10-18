<?php

namespace App\Http\Requests\Revisiones;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class PeriodoRevisionRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        $periodo = $this->route('periodo');

        return [
            'anio' => ['required', 'integer', 'min:2000', 'max:2100'],
            'mes' => [
                'required',
                'integer',
                'min:1',
                'max:12',
                Rule::unique('periodos_revision', 'mes')
                    ->where(fn ($q) => $q->where('anio', $this->input('anio')))
                    ->ignore($periodo?->id),
            ],
        ];
    }
}
