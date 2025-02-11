<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UnidadeRequest extends FormRequest
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
            'nome_fantasia' => 'required|string|max:255',
            'razao_social' => 'required|string|max:255',
            'cnpj' => 'required|string|size:18',
            'bandeira_id' => 'required|integer|exists:bandeiras,id',
        ];
    }

    public function messages(): array
    {
        return [
            'nome_fantasia.required' => 'O nome fantasia é obrigatório.',
            'nome_fantasia.string' => 'O nome fantasia deve ser um texto.',
            'razao_social.required' => 'A razão social é obrigatória.',
            'razao_social.string' => 'A razão social deve ser um texto.',
            'cnpj.required' => 'O CNPJ é obrigatório.',
            'cnpj.string' => 'O CNPJ deve não ser um texto.',
            'cnpj.size' => 'O CNPJ deve ter 14 caracteres.',
            'bandeira.required' => 'A bandeira é obrigatória.',
        ];
    }
}
