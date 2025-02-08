<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class BandeiraRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'nome' => 'required|string|max:255',
             'grupo_economico_id' => 'required|integer',
        ];
    }

    public function messages(): array
    {
        return [
            'nome.required' => 'O nome do colaborador é obrigatório.',
            'nome.string' => 'O nome do colaborador deve ser um texto.',
            'grupo_economico_id.required' => 'O grupo econômico é obrigatório.',
            'grupo_economico_id.integer' => 'O grupo econômico deve ser um número inteiro.',  
        ];
    }
}
