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
            <div class="card-header bg-primary text-white">Detalhes do Colaborador</div>
            <div class="card-body">
                <div class="row mb-3">
                    <div class="col-md-6">
                        <label for="nome" class="form-label">Nome</label>
                        <input type="text" class="form-control" id="nome" name="nome" value="{{ $colaborador->nome }}" readonly>
                    </div>
                </div>
                <a href="{{ route('colaborador.index') }}" class="btn btn-secondary">Voltar</a>
                <a href="{{ route('colaborador.edit', $colaborador->id) }}" class="btn btn-warning">Editar</a>
                <form action="{{ route('colaborador.destroy', $colaborador->id) }}" method="POST" style="display:inline;">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger" onclick="return confirm('Deseja realmente excluir este colaborador?')">Excluir</button>
                </form>
            </div>
        </div>
    </div>
</div>

