<?php

namespace App\Http\Controllers;

use App\Models\Bandeira;
use Illuminate\Http\Request;
use App\Models\Unidade;

class UnidadeController extends Controller
{
    public function index(Request $request)
    {
        $unidades = Unidade::all();
        $bandeira = Bandeira::all();
        $mensagem = $request->session()->get('mensagem');
        return view('unidades.index', compact('unidades','bandeira','mensagem'));
    }

    public function create()
    {
        return view('unidades.create');
    }

    public function store(Request $request)
    {
        Unidade::create([
            'nome' => $request->nome,
            'nome_fantasia'  => $request->nome_fantasia,
            'razao_social' => $request->razao_social,
            'cnpj' => $request->cnpj,
            'bandeira_id' => $request->bandeira_id,
            'usuario_id' => auth()->id(), 
        ]);
        return redirect()->route('unidades.index')->with('success', 'Unidade criada com sucesso!');
    }

    public function show(Unidade $unidade)
    {
        return view('unidades.show', compact('unidade'));
    }

    public function edit($id)
    {
        $unidade = Unidade::find($id);
        $bandeira = Bandeira::all();
        return view('unidades.edit', compact('unidade','bandeira'));
    }

    public function update(Request $request, Unidade $unidade)
    {
   
        $unidade->update($request->all());
        return redirect()->route('unidades.index')->with('success', 'Unidade atualizada com sucesso!');
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

}