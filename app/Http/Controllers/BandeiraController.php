<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Bandeira;
use App\Models\GrupoEconomico;

class BandeiraController extends Controller
{
    public function index(Request $request)
    {
        $bandeiras = Bandeira::all();
        $grupos = GrupoEconomico::all();
        $mensagem = $request->session()->get('mensagem');
        return view('bandeira.index', compact('bandeiras', 'mensagem','grupos'));
    }

    public function create()
    {
        return view('bandeiras.create');
    }

    public function store(Request $request)
    {
        Bandeira::create([
            'nome' => $request->nome,
            'grupo_economico_id' => $request->grupo_economico_id,
            'usuario_id' => auth()->id(),
        ]);
        
        return redirect()->route('bandeira.index')->with('success', 'Bandeira criada com sucesso!');
    }

    public function show(Bandeira $bandeira)
    {
        return view('bandeiras.show', compact('bandeira'));
    }

    public function edit(Request $request, Bandeira $bandeira, $id)
    {
        $slot = 'Editar Bandeira';
        $header = 'Editar Bandeira';
        $bandeira = Bandeira::find($id);
        $grupos   = GrupoEconomico::all();

        return view('bandeira.edit', compact('bandeira','grupos', 'header' , 'slot'));

        /*
        try {
            $despesas = Bandeira::find($id);
            $mensagem = $request->session()->get('mensagem');
           
            return view('despesas.edit', compact('despesas', 'categorias', 'mensagem'));
        } catch (\Exception $e) {
            return redirect()->back()->withErrors('Erro ao carregar o formulário de criação: ' . $e->getMessage());
        }
       */     
    }

    public function update(Request $request, Bandeira $bandeira, $id)
    {
        $bandeira = Bandeira::findOrFail($id);
        $bandeira->update($request->all());
        return redirect()->route('bandeiras.index')->with('success', 'Despesas atualizada com sucesso!');
    }

    public function destroy(Bandeira $bandeira)
    {
        $bandeira->delete();
        return redirect()->route('bandeiras.index')->with('success', 'Bandeira removida com sucesso!');
    }
}