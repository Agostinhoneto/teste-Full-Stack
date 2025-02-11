<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\GrupoEconomico;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class GrupoEconomicoController extends Controller
{
    public function index(Request $request)
    {
        $grupos = GrupoEconomico::all();
        $mensagem = $request->session()->get('mensagem');

        return view('grupos.index', compact('grupos', 'mensagem'));
    }

    public function create()
    {
        return view('grupos.create');
    }

    public function store(Request $request)
    {
        GrupoEconomico::create([
            'nome' => $request->nome,
            'usuario_id' => auth()->id(),
        ]);
        return redirect()->route('grupo-economico.index')->with('success', 'Grupo Econômico criado com sucesso.');
    }

    public function edit(Request $request, GrupoEconomico $grupo,$id)
    {
        $grupo = GrupoEconomico::find($id);

        return view('grupos.edit', compact('grupo'));
    }

    public function update(Request $request, GrupoEconomico $grupo)
    {
        $request->validate([
            'nome' => 'required|string|max:255',
            'cnpj' => ['required', 'string', 'size:18', Rule::unique('grupo_economicos')->ignore($grupo->id), function ($attribute, $value, $fail) {
                if (!$this->validarCnpj($value)) {
                    $fail('O CNPJ informado não é válido.');
                }
            }],
        ]);

        $grupo->update($request->all());

        return redirect()->route('grupo-economico.index')->with('success', 'Grupo Econômico atualizado com sucesso.');
    }

    
    public function destroy($id)
    {
        try {
            $grupo = GrupoEconomico::findOrFail($id);
            $grupo->delete();

            return redirect()->route('grupo-economico.index')->with('success', 'Grupo excluído com sucesso!');
        } catch (\Exception $e) {
            \Illuminate\Support\Facades\Log::error('Erro ao excluir categoria: ' . $e->getMessage());
            return back()->withErrors('Erro ao excluir a categoria. Tente novamente mais tarde.');
        }
    }


    private function validarCnpj($cnpj)
    {
        $cnpj = preg_replace('/[^0-9]/', '', $cnpj);
        if (strlen($cnpj) != 14) return false;

        $soma1 = 0;
        $soma2 = 0;
        $pesos1 = [5, 4, 3, 2, 9, 8, 7, 6, 5, 4, 3, 2];
        $pesos2 = [6, 5, 4, 3, 2, 9, 8, 7, 6, 5, 4, 3, 2];

        for ($i = 0; $i < 12; $i++) {
            $soma1 += $cnpj[$i] * $pesos1[$i];
        }

        $resto = $soma1 % 11;
        $digito1 = $resto < 2 ? 0 : 11 - $resto;

        for ($i = 0; $i < 13; $i++) {
            $soma2 += $cnpj[$i] * $pesos2[$i];
        }

        $resto = $soma2 % 11;
        $digito2 = $resto < 2 ? 0 : 11 - $resto;

        return ($cnpj[12] == $digito1 && $cnpj[13] == $digito2);
    }
}
