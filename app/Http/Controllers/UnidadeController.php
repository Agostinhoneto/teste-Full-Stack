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
                'cnpj' => $request->cnpj ,
                'bandeira_id' => $request->bandeira_id,
                'usuario_cadastrante_id' => auth()->id(), 
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

    public function update(Request $request, $id)
    {
        try {
            $unidade = Unidade::findOrFail($id);
            $unidade->update([
                'nome' => $request->nome,
                'nome_fantasia'  => $request->nome_fantasia,
                'razao_social' => $request->razao_social,
                'cnpj' => $request->cnpj,
                'bandeira_id' => $request->bandeira_id,
                'usuario_alterante_id' => auth()->id(),
            ]);
    
            return redirect()->route('unidades.index')->with('success', 'Unidade atualizada com sucesso!');
        } catch (\Exception $e) {
            dd($e);
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
            \Illuminate\Support\Facades\Log::error('Erro ao excluir unidade: ' . $e->getMessage());
            return back()->withErrors('Erro ao excluir a unidade. Tente novamente mais tarde.');
        }
    }
}