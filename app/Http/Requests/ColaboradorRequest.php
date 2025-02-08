<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ColaboradorRequest extends FormRequest
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
    public function rules(): array
    {
        return [
            'nome' => 'required|string|max:255',
            'email' => 'required|email|unique:colaboradores,email,' . $this->colaborador,
            'cpf' =>    'required|string|max:14',
            'unidade_id' => 'required|integer',   
        ];
    }

    public function messages(): array
    {
        return [
            'nome.required' => 'O nome do colaborador é obrigatório.',
            'email.required' => 'O e-mail é obrigatório.',
            'email.email' => 'Informe um e-mail válido.',
            'email.unique' => 'Este e-mail já está cadastrado.',
            'cpf.required' => 'O CPF é obrigatório.',
            'unidade_id.required' => 'A unidade é obrigatória.',            
        ];
    }
}
