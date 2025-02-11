<?php

namespace App\Http\Controllers;

use App\Http\Requests\UnidadeRequest;
use App\Models\Bandeira;
use Illuminate\Http\Request;
use App\Models\Unidade;

class UnidadeController extends Controller
{
    public function index(Request $request)
    {
        try {
            $unidades = Unidade::all();
            $bandeira = Bandeira::all();
            $mensagem = $request->session()->get('mensagem');
            return view('unidades.index', compact('unidades', 'bandeira', 'mensagem'));
        } catch (\Exception $e) {
            \Illuminate\Support\Facades\Log::error('Erro ao carregar unidades: ' . $e->getMessage());
            return back()->withErrors('Erro ao carregar as unidades. Tente novamente mais tarde.');
        }
    }

    public function create()
    {
        return view('unidades.create');
    }

    public function store(UnidadeRequest $request)
    {
        try {
            Unidade::create([
                'nome' => $request->nome,
                'nome_fantasia'  => $request->nome_fantasia,
                'razao_social' => $request->razao_social,
                'cnpj' => $this->validarCnpj($request->cnpj) ? $request->cnpj : throw new \Exception('CNPJ inválido'),
                'bandeira_id' => $request->bandeira_id,
                'usuario_id' => auth()->id(), 
            ]);
            return redirect()->route('unidades.index')->with('success', 'Unidade criada com sucesso!');
        } catch (\Exception $e) {
            \Illuminate\Support\Facades\Log::error('Erro ao criar unidade: ' . $e->getMessage());
            return back()->withErrors('Erro ao criar a unidade. Tente novamente mais tarde.');
        }
    }

    public function show($id)
    {
        try {
            $unidade = Unidade::findOrFail($id);
            return view('unidades.show', compact('unidade'));
        } catch (\Exception $e) {
            \Illuminate\Support\Facades\Log::error('Erro ao carregar unidade: ' . $e->getMessage());
            return back()->withErrors('Erro ao carregar a unidade. Tente novamente mais tarde.');
        }
    }

    public function edit($id)
    {
        try {
            $unidade = Unidade::find($id);
            $bandeira = Bandeira::all();
            return view('unidades.edit', compact('unidade', 'bandeira'));
        } catch (\Exception $e) {
            \Illuminate\Support\Facades\Log::error('Erro ao carregar unidade para edição: ' . $e->getMessage());
            return back()->withErrors('Erro ao carregar a unidade para edição. Tente novamente mais tarde.');
        }
    }

    public function update(UnidadeRequest $request, Unidade $unidade)
    {
        
        try {
            $unidade->update([
            'nome' => $request->nome,
            'nome_fantasia'  => $request->nome_fantasia,
            'razao_social' => $request->razao_social,
            'cnpj' => $this->validarCnpj($request->cnpj) ? $request->cnpj : throw new \Exception('CNPJ inválido'),
            'bandeira_id' => $request->bandeira_id,
            'usuario_id' => auth()->id(), 
            ]);
            return redirect()->route('unidades.index')->with('success', 'Unidade atualizada com sucesso!');
        } catch (\Exception $e) {
            \Illuminate\Support\Facades\Log::error('Erro ao atualizar unidade: ' . $e->getMessage());
            return back()->withErrors('Erro ao atualizar a unidade. Tente novamente mais tarde.');
        }
     }

    
    public function destroy($id)
    {
        try {
            $unidade = Unidade::findOrFail($id);
            $unidade->delete();

            return redirect()->route('unidades.index')->with('success', 'Unidade excluída com sucesso!');
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