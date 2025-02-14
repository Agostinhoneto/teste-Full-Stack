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
            <div class="card-header bg-secondary text-white">Adicionar Nova Bandeira</div>
            <div class="card-body">
                <form action="{{ route('bandeira.store') }}" method="POST">
                    @csrf
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="name" class="form-label">Nome *</label>
                            <input type="text" class="form-control @error('nome') is-invalid @enderror" id="name" name="nome" value="{{ old('nome') }}" required>
                            @error('nome')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="grupo_economico" class="form-label fw-bold">
                            <i class="fas fa-building"></i> Grupo Econômico:
                        </label>
                        <select name="grupo_economico_id" id="grupo_economico" class="form-control select2bs4 border-primary shadow-sm" required>
                            <option value="" selected disabled>Selecione um grupo econômico...</option>
                            @foreach($grupos as $g)
                            <option value="{{ $g->id }}">
                                {{ $g->nome }}
                            </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="text-danger mb-3">* Campos obrigatórios</div>
                    <button type="submit" class="btn btn-primary">Salvar</button>
                </form>
            </div>
        </div>

        <div class="card">
            <div class="card-header bg-secondary text-white">Lista de Bandeiras</div>
            <div class="card-body">
                <table class="table table-bordered table-hover">
                    <thead class="thead-dark">
                        <tr>
                            <th>#</th>
                            <th>Nome</th>
                            <th>Grupo Econômico</th>
                            <th>Ações</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($bandeiras as $b)
                        <tr>
                            <td>{{ $b->id }}</td>
                            <td>{{ $b->nome }}</td>
                            <td>{{ $b->grupo->nome }}</td>
                            <td>
                                <a href="{{ route('bandeira.show', $b->id) }}" class="btn btn-info btn-sm">
                                    <i class="fas fa-eye"></i> Ver
                                </a>
                                <a href="{{ route('bandeira.edit', $b->id) }}" class="btn btn-warning btn-sm">
                                    <i class="fas fa-edit"></i> Editar
                                </a>
                                <form action="{{ route('bandeira.destroy', $b->id) }}" method="POST" style="display:inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Deseja realmente excluir este Bandeira?')">
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

<!-- Select2 -->
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script>
    $(document).ready(function() {
        $('#permissions').select2({
            placeholder: "Selecione as permissões",
            allowClear: true,
            width: '100%'
        });
    });
</script>