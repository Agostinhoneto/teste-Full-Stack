<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Colaborador;
use App\Models\Unidade;
use Illuminate\Http\Request;

class ColaboradorController extends Controller
{
  
    public function index(Request $request)
    {
        $colaboradores = Colaborador::all();
        $unidades = Unidade::all();

        $mensagem = $request->session()->get('mensagem');
        return view('colaborador.index', compact('colaboradores','mensagem','unidades'));
    }
 
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('colaborador.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
        ]);

        $colaborador = new Colaborador();
        $colaborador->name = $validatedData['name'];
        $colaborador->email = $validatedData['email'];
        $colaborador->password = bcrypt($validatedData['password']);
        $colaborador->save();

        return view('colaborador.index', compact('colaboradores'));
    }
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $colaborador = Colaborador::findOrFail($id);
        return view('colaborador.show', compact('colaborador'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $colaborador = Colaborador::findOrFail($id);
        return view('colaborador.edit', compact('colaborador'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
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

        return redirect()->route('colaborador.index')->with('success', 'Colaborador updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $colaborador = Colaborador::findOrFail($id);
        $colaborador->delete();

        return redirect()->route('colaborador.index')->with('success', 'Colaborador deleted successfully');
    }
}
