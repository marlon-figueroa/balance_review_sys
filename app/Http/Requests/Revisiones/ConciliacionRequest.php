<?php

namespace App\Http\Requests\Revisiones;

use Illuminate\Foundation\Http\FormRequest;

class ConciliacionRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'tipo' => ['required', 'string', 'max:32'],
            'referencia' => ['required', 'string', 'max:255'],
            'saldo_contable' => ['required', 'numeric'],
            'saldo_externo' => ['required', 'numeric'],
        ];
    }
}
