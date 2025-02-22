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
            <div class="card-header bg-success text-white">Adicionar Nova Unidades</div>
            <div class="card-body">
                <form action="{{ route('unidades.store') }}" method="POST">
                    @csrf
                    <div class="row">
                        <div class="col-md-4 mb-3">
                            <label for="nome_fantasia" class="form-label">Nome Fantasia</label>
                            <input type="text" class="form-control @error('nome_fantasia') is-invalid @enderror" id="nome_fantasia" name="nome_fantasia" value="{{ old('nome_fantasia') }}" required>
                            @error('nome_fantasia')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-md-4 mb-3">
                            <label for="razao_social" class="form-label">Razão Social</label>
                            <input type="text" class="form-control @error('razao_social') is-invalid @enderror" id="razao_social" name="razao_social" value="{{ old('razao_social') }}" required>
                            @error('razao_social')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-md-4 mb-3">
                            <label for="cnpj" class="form-label">CNPJ</label>
                            <input type="text" class="form-control @error('cnpj') is-invalid @enderror" id="cnpj" name="cnpj" value="{{ old('cnpj') }}" oninput="mascaraCNPJ(this)" maxlength="18" required>
                            @error('cnpj')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-md-4 mb-3">
                            <label for="bandeira_id" class="form-label">Bandeira :</label>
                            <select name="bandeira_id" id="bandeira_id" class="form-control @error('bandeira_id') is-invalid @enderror" required>
                                <option value="" selected disabled>Selecione uma Bandeira...</option>
                                @foreach($bandeiras as $b)
                                <option value="{{ $b->id }}" {{ old('bandeira_id') == $b->id ? 'selected' : '' }}>
                                    {{ $b->nome }}
                                </option>
                                @endforeach
                            </select>
                            @error('bandeira_id')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <script>
                        function mascaraCNPJ(input) {
                            let value = input.value.replace(/\D/g, '');
                            value = value.replace(/^(\d{2})(\d)/, '$1.$2');
                            value = value.replace(/^(\d{2})\.(\d{3})(\d)/, '$1.$2.$3');
                            value = value.replace(/\.(\d{3})(\d)/, '.$1/$2');
                            value = value.replace(/(\d{4})(\d)/, '$1-$2');
                            input.value = value;
                        }
                    </script>
                    <div class="text-danger mb-3">* Campos obrigatórios</div>
                    <button type="submit" class="btn btn-primary">Salvar</button>
                </form>
            </div>
        </div>
        <div class="card">
            <div class="card-header bg-secondary text-white">Lista de Usuários</div>
            <div class="card-body">
                <table class="table table-bordered table-hover">
                    <thead class="thead-dark">
                        <tr>
                            <th>#</th>
                            <th>Nome Fantasia</th>
                            <th>CNPJ</th>
                            <th>Razão Social</th>
                            <th>Bandeira</th>
                            <th>Ações</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($unidades as $und)
                        <tr>
                            <td>{{ $und->id }}</td>
                            <td>{{ $und->nome_fantasia }}</td>
                            <td>{{ $und->cnpj }}</td>
                            <td>{{ $und->razao_social }}</td>
                            <td>{{ $und->bandeira->nome }}</td>   
                            <td>
                                <a href="{{ route('unidades.show', $und->id) }}" class="btn btn-info btn-sm">
                                    <i class="fas fa-eye"></i> Ver
                                </a>
                                <a href="{{ route('unidades.edit', $und->id) }}" class="btn btn-warning btn-sm">
                                    <i class="fas fa-edit"></i> Editar
                                </a>
                                <form action="{{ route('unidades.destroy', $und->id) }}" method="POST" style="display:inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Deseja realmente excluir este unidades?')">
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
