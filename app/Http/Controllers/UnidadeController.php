<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Unidade;

class UnidadeController extends Controller
{
    public function index()
    {
        $unidades = Unidade::all();
        return view('unidades.index', compact('unidades'));
    }

    public function create()
    {
        return view('unidades.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nome' => 'required|string|max:255',
            'sigla' => 'nullable|string|max:10',
        ]);

        Unidade::create($request->all());
        return redirect()->route('unidades.index')->with('success', 'Unidade criada com sucesso!');
    }

    public function show(Unidade $unidade)
    {
        return view('unidades.show', compact('unidade'));
    }

    public function edit(Unidade $unidade)
    {
        return view('unidades.edit', compact('unidade'));
    }

    public function update(Request $request, Unidade $unidade)
    {
        $request->validate([
            'nome' => 'required|string|max:255',
            'sigla' => 'nullable|string|max:10',
        ]);

        $unidade->update($request->all());
        return redirect()->route('unidades.index')->with('success', 'Unidade atualizada com sucesso!');
    }

    public function destroy(Unidade $unidade)
    {
        $unidade->delete();
        return redirect()->route('unidades.index')->with('success', 'Unidade removida com sucesso!');
    }
}