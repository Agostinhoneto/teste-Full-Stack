<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\GrupoEconomicoRequest;
use App\Models\GrupoEconomico;
use Illuminate\Http\Request;

class GrupoEconomicoController extends Controller
{
    public function index(Request $request)
    {
        try {
            $grupos = GrupoEconomico::all();
            $mensagem = $request->session()->get('mensagem');

            return view('grupos.index', compact('grupos', 'mensagem'));
        } catch (\Exception $e) {
            \Illuminate\Support\Facades\Log::error('Erro ao carregar grupos econômicos: ' . $e->getMessage());
            return back()->withErrors('Erro ao carregar os grupos econômicos. Tente novamente mais tarde.');
        }
    }

    public function create()
    {
        return view('grupos.create');
    }

    public function store(GrupoEconomicoRequest $request)
    {
        try {
            GrupoEconomico::create([
                'nome' => $request->nome,
                'usuario_id' => auth()->id(),
            ]);
            return redirect()->route('grupo-economico.index')->with('success', 'Grupo Econômico criado com sucesso.');
        } catch (\Exception $e) {
            \Illuminate\Support\Facades\Log::error('Erro ao criar grupo econômico: ' . $e->getMessage());
            return back()->withErrors('Erro ao criar o grupo econômico. Tente novamente mais tarde.');
        }
    }

    public function edit(Request $request, GrupoEconomico $grupo, $id)
    {
        $grupo = GrupoEconomico::find($id);

        return view('grupos.edit', compact('grupo'));
    }

    public function update(GrupoEconomicoRequest $request, GrupoEconomico $grupo)
    {
        try {
            $grupo->update([
                'nome' => $request->nome,
            ]);

            return redirect()->route('grupo-economico.index')->with('success', 'Grupo Econômico atualizado com sucesso.');
        } catch (\Exception $e) {
            \Illuminate\Support\Facades\Log::error('Erro ao atualizar grupo econômico: ' . $e->getMessage());
            return back()->withErrors('Erro ao atualizar o grupo econômico. Tente novamente mais tarde.');
        }
    }


    public function destroy($id)
    {
        try {
            $grupo = GrupoEconomico::findOrFail($id);
            $grupo->delete();

            return redirect()->route('grupo-economico.index')->with('success', 'Grupo excluído com sucesso!');
        } catch (\Exception $e) {
            \Illuminate\Support\Facades\Log::error('Erro ao excluir grupo: ' . $e->getMessage());
            return back()->withErrors('Erro ao excluir a grupo. Tente novamente mais tarde.');
        }
    }
}
