<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Colaborador;
use App\Models\Unidade;
use Database\Seeders\Admin;
use Illuminate\Http\Request;

class ColaboradorController extends Controller
{
  
    public function index(Request $request)
    {
        $colaboradores = Colaborador::all();
        $unidades = Unidade::all();
        return view('colaborador.index', compact('colaboradores','unidades'));
    }
 
    public function create()
    {
        return view('colaborador.create');
    }

   
    public function store(Request $request)
    {
        Colaborador::create([
            'nome' => $request->nome,
            'email' => $request->email,
            'cpf' => $request->cpf,
            'unidade_id' => $request->unidade_id,
            'usuario_id' => auth()->id(), 
        ]);
        return view('colaborador.index');
    }
  
    public function show($id)
    {
        $colaborador = Colaborador::findOrFail($id);
        return view('colaborador.show', compact('colaborador'));
    }

    public function edit($id)
    {
        $colaborador = Colaborador::findOrFail($id);
        return view('colaborador.edit', compact('colaborador'));
    }

    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . $id,
            'password' => 'nullable|string|min:8|confirmed',
        ]);

        $colaborador = Colaborador::findOrFail($id);
        $colaborador->name = $validatedData['name'];
        $colaborador->email = $validatedData['email'];
        if (!empty($validatedData['password'])) {
            $colaborador->password = bcrypt($validatedData['password']);
        }
        $colaborador->save();

        return redirect()->route('colaborador.index')->with('success', 'Colaborador ');
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
