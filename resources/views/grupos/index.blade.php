@include('layouts.topo')
@extends('layout')
@if(session('success'))
    <div class="alert alert-success text-center w-75 mx-auto">
        {{ session('success') }}
    </div>
@endif

@if($errors->any())
    <div class="alert alert-danger text-center w-75 mx-auto">
        <ul class="mb-0">
            @foreach($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
<style>
    .card-header {
        font-weight: bold;
        font-size: 1.2rem;
    }

    .btn {
        margin-right: 5px;
    }

    .table th, .table td {
        text-align: center;
        vertical-align: middle;
    }
</style>

<div x-data="{ sidebarOpen: false }" class="flex h-screen bg-gray-200 font-roboto">
    @include('layouts.sidebar')
    <div class="container my-4">
        <div class="card mb-4">
            <div class="card-header bg-primary text-white">Adicionar Novo Grupo Econômico</div>
            <div class="card-body">
            <form action="{{ route('grupo-economico.store') }}" method="POST">
                @csrf
                <div class="row">
                <div class="col-md-6 mb-3">
                    <label for="name" class="form-label">Nome *</label>
                    <input type="text" class="form-control @error('name') is-invalid @enderror" id="nome" name="nome" value="{{ old('nome') }}" required>
                    @error('name')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                </div>
                <div class="text-danger mb-3">* Campos obrigatórios</div>
                <button type="submit" class="btn btn-primary">Salvar</button>
            </form>
            </div>
        </div>

        @include('components.flash-message')
        <div class="card">
            <div class="card-header bg-secondary text-white">Lista de Grupo Econômico</div>
            <div class="card-body">
                <table class="table table-bordered table-hover">
                    <thead class="thead-dark">
                        <tr>
                            <th>#</th>
                            <th>Nome</th>
                            <th>Ações</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($grupos as $g)
                        <tr>
                            <td>{{ $g->id }}</td>
                            <td>{{ $g->nome }}</td>
                            <td>
                                <a href="{{ route('grupo-economico.show', $g->id) }}" class="btn btn-info btn-sm">
                                    <i class="fas fa-eye"></i> Ver
                                </a>
                                <a href="{{ route('grupo-economico.edit', $g->id) }}" class="btn btn-warning btn-sm">
                                    <i class="fas fa-edit"></i> Editar
                                </a>
                                <form action="{{ route('grupo-economico.destroy', $g->id) }}" method="POST" style="display:inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Deseja realmente excluir este grupo economico?')">
                                        <i class="fas fa-trash-alt"></i> Excluir
                                    </button>
                                </form>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

