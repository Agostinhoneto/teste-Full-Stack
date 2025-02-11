<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\BandeiraRequest;
use Illuminate\Http\Request;
use App\Models\Bandeira;
use App\Models\GrupoEconomico;

class BandeiraController extends Controller
{
    public function index(Request $request)
    {
        try {
            $bandeiras = Bandeira::all();
            $grupos = GrupoEconomico::all();
            $mensagem = $request->session()->get('mensagem');
            return view('bandeira.index', compact('bandeiras', 'mensagem', 'grupos'));
        } catch (\Exception $e) {
            return redirect()->back()->withErrors('Erro ao carregar a lista de bandeiras: ' . $e->getMessage());
        }
    }
    public function create()
    {
        return view('bandeiras.create');
    }

    public function store(BandeiraRequest $request)
    {
        try {
            Bandeira::create([
            'nome' => $request->nome,
            'grupo_economico_id' => $request->grupo_economico_id,
            'usuario_id' => auth()->id(),
            ]);

            return redirect()->route('bandeira.index')->with('success', 'Bandeira criada com sucesso!');
        } catch (\Exception $e) {
            return redirect()->back()->withErrors('Erro ao criar a bandeira: ' . $e->getMessage());
        }
    }

    public function show(Bandeira $bandeira)
    {
        return view('bandeiras.show', compact('bandeira'));
    }

    public function edit(Request $request, Bandeira $bandeira, $id)
    {
        try {
            $slot = 'Editar Bandeira';
            $header = 'Editar Bandeira';
            $bandeira = Bandeira::findOrFail($id);
            $grupos = GrupoEconomico::all();

            return view('bandeira.edit', compact('bandeira', 'grupos', 'header', 'slot'));
        } catch (\Exception $e) {
            return redirect()->back()->withErrors('Erro ao carregar a bandeira para edição: ' . $e->getMessage());
        }

    }

    public function update(BandeiraRequest $request, Bandeira $bandeira, $id)
    {
        try {
            $bandeira = Bandeira::findOrFail($id);
            $bandeira->update([
            'nome' => $request->nome,
            'grupo_economico_id' => $request->grupo_economico_id,
            'usuario_id' => auth()->id(),
            ]);

            return redirect()->route('bandeira.index')->with('success', 'Bandeira atualizada com sucesso!');
        } catch (\Exception $e) {
            return redirect()->back()->withErrors('Erro ao atualizar a bandeira: ' . $e->getMessage());
        }
    }

    public function destroy(Bandeira $bandeira)
    {
        $bandeira->delete();
        return redirect()->route('bandeiras.index')->with('success', 'Bandeira removida com sucesso!');
    }
}
