<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\ColaboradorRequest;
use App\Models\Colaborador;
use App\Models\Unidade;
use Illuminate\Http\Request;

class ColaboradorController extends Controller
{

    public function index(Request $request)
    {
        try {
            $colaboradores = Colaborador::all();
            $unidades = Unidade::all();
            return view('colaborador.index', compact('colaboradores', 'unidades'));
        } catch (\Exception $e) {
            \Illuminate\Support\Facades\Log::error('Erro ao carregar colaboradores: ' . $e->getMessage());
            return back()->withErrors('Erro ao carregar colaboradores. Tente novamente mais tarde.');
        }
    }

    public function create()
    {
        return view('colaborador.create');
    }


    public function store(ColaboradorRequest $request)
    {
        try {
            Colaborador::create([
                'nome' => $request->nome,
                'email' => $request->email,
                'cpf' => $request->cpf,
                'unidade_id' => $request->unidade_id,
                'usuario_cadastrante_id' => auth()->id(),
            ]);
            return redirect()->route('colaborador.index')->with('success', 'Colaborador criado com sucesso!');
        } catch (\Exception $e) {
            \Illuminate\Support\Facades\Log::error('Erro ao criar colaborador: ' . $e->getMessage());
            return back()->withErrors('Erro ao criar colaborador. Tente novamente mais tarde.');
        }
    }

    public function show($id)
    {
        try {
            $colaborador = Colaborador::findOrFail($id);
            return view('colaborador.show', compact('colaborador'));
        } catch (\Exception $e) {
            \Illuminate\Support\Facades\Log::error('Erro ao exibir colaborador: ' . $e->getMessage());
            return back()->withErrors('Erro ao exibir colaborador. Tente novamente mais tarde.');
        }
    }

    public function edit($id)
    {
        $colaborador = Colaborador::findOrFail($id);
        $unidades = Unidade::all();
        return view('colaborador.edit', compact('colaborador', 'unidades'));
    }

    public function update(Request $request, $id)
    {
        try {
            $colaborador = Colaborador::findOrFail($id);
            $colaborador->update([
                'nome' => $request->nome,
                'email' => $request->email,
                'cpf' => $request->cpf,
                'unidade_id' => $request->unidade_id,
                'usuario_alterante_id' => auth()->id(),
            ]);
            return redirect()->route('colaborador.index')->with('success', 'Colaborador atualizado com sucesso!');
        } catch (\Exception $e) {
            \Illuminate\Support\Facades\Log::error('Erro ao atualizar colaborador: ' . $e->getMessage());
            return back()->withErrors('Erro ao atualizar colaborador. Tente novamente mais tarde.');
        }
    }


    public function destroy($id)
    {
        try {
            $colaborador = Colaborador::findOrFail($id);
            $colaborador->delete();

            return redirect()->route('colaborador.index')->with('success', 'Colaborador excluída com sucesso!');
        } catch (\Exception $e) {
            \Illuminate\Support\Facades\Log::error('Erro ao excluir categoria: ' . $e->getMessage());
            return back()->withErrors('Erro ao excluir a categoria. Tente novamente mais tarde.');
        }
    }
}
