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
        Bandeira::create($request->all());
        return redirect()->route('bandeira.index')->with('success', 'Bandeira criada com sucesso!');
    }

    public function show(Bandeira $bandeira)
    {
        return view('bandeiras.show', compact('bandeira'));
    }

    public function edit(Bandeira $bandeira)
    {
        return view('bandeiras.edit', compact('bandeira'));
    }

    public function update(Request $request, Bandeira $bandeira)
    {
        $request->validate([
            'nome' => 'required|string|max:255',
        ]);

        $bandeira->update($request->all());
        return redirect()->route('bandeiras.index')->with('success', 'Bandeira atualizada com sucesso!');
    }

    public function destroy(Bandeira $bandeira)
    {
        $bandeira->delete();
        return redirect()->route('bandeiras.index')->with('success', 'Bandeira removida com sucesso!');
    }
}