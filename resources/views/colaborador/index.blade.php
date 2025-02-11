@include('layouts.topo')
@extends('layout')

<style>
    .card-header {
        font-weight: bold;
        font-size: 1.2rem;
    }

    .btn {
        margin-right: 5px;
    }

    .table th,
    .table td {
        text-align: center;
        vertical-align: middle;
    }
</style>

<div x-data="{ sidebarOpen: false }" class="flex h-screen bg-gray-200 font-roboto">
    @include('layouts.sidebar')

    <div class="container my-4">
        <div class="card mb-4">
            <div class="card-header bg-primary text-white">Adicionar Novo Colaborador</div>
            <div class="card-body">
                <form action="{{ route('colaborador.store') }}" method="POST">
                    @csrf
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="nome" class="form-label">Nome</label>
                            <input type="text" class="form-control @error('nome') is-invalid @enderror" id="nome" name="nome" value="{{ old('nome') }}">
                            @error('nome')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" class="form-control @error('email') is-invalid @enderror" id="email" name="email" value="{{ old('email') }}">
                            @error('email')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-md-6 mb-3">
                            <label for="name" class="form-label">CPF</label>
                            <input type="text" class="form-control @error('cpf') is-invalid @enderror" id="cpf" name="cpf" value="{{ old('cpf') }}">
                            @error('cpf')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="unidade_id" class="form-label fw-bold">
                                <i class="fas fa-building"></i>Unidades:
                            </label>
                            <select name="unidade_id" id="unidade_id" class="form-control select2bs4 border-primary shadow-sm" required>
                                <option value="" selected disabled>Selecione uma Unidade...</option>
                                @foreach($unidades as $u)
                                <option value="{{ $u->id }}">
                                    {{ $u->nome_fantasia }}
                                </option>
                                @endforeach
                            </select>
                        </div>
                    </div>                  
                    <button type="submit" class="btn btn-primary">Salvar</button>
                </form>
            </div>
        </div>
        <div class="card">
            <div class="card-header bg-secondary text-white">Lista de Colaboradores</div>
            <div class="card-body">
                <table class="table table-bordered table-hover">
                    <thead class="thead-dark">
                        <tr>
                            <th>#</th>
                            <th>Nome </th>
                            <th>CPF</th>
                            <th>Email</th>
                            <th>Unidade</th>
                            <th>Ações</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($colaboradores as $col)
                        <tr>
                            <td>{{ $col->id }}</td>
                            <td>{{ $col->nome }}</td>
                            <td>{{ $col->cpf }}</td>
                            <td>{{ $col->email }}</td>
                            <td>{{ $col->unidades->nome_fantasia }}</td>   
                            <td>
                                <a href="{{ route('colaborador.edit', $col->id) }}" class="btn btn-warning btn-sm">
                                    <i class="fas fa-edit"></i> Editar
                                </a>
                                <form action="{{ route('colaborador.destroy', $col->id) }}" method="POST" style="display:inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Deseja realmente excluir este Colaborador?')">
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
