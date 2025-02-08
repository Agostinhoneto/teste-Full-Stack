<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Bandeira;

class BandeiraController extends Controller
{
    public function index()
    {
        $bandeiras = Bandeira::all();
        return view('bandeiras.index', compact('bandeiras'));
    }

    public function create()
    {
        return view('bandeira.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nome' => 'required|string|max:255',
        ]);

        Bandeira::create($request->all());
        return redirect()->route('bandeira.index')->with('success', 'Bandeira criada com sucesso!');
    }

    public function show(Bandeira $bandeira)
    {
        return view('bandeira.show', compact('bandeira'));
    }

    public function edit(Bandeira $bandeira)
    {
        return view('bandeira.edit', compact('bandeira'));
    }

    public function update(Request $request, Bandeira $bandeira)
    {
        $request->validate([
            'nome' => 'required|string|max:255',
        ]);

        $bandeira->update($request->all());
        return redirect()->route('bandeira.index')->with('success', 'Bandeira atualizada com sucesso!');
    }

    public function destroy(Bandeira $bandeira)
    {
        $bandeira->delete();
        return redirect()->route('bandeira.index')->with('success', 'Bandeira removida com sucesso!');
    }
}