@include('layouts.topo')
@extends('layout')
<div class="wrapper">
    <div class="content-wrapper">
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0 text-dark">Editar Informações</h1>
                    </div>
                </div>
            </div>
        </div>
        @include('layouts.sidebar')
        <div class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">Formulário de Edição Colaborador</h3>
                            </div>
                            <div class="card-body">
                                <form action="{{ route('colaborador.update', $colaborador->id) }}" method="POST">
                                    @csrf
                                    @method('PUT')
                                    <div class="mb-3">
                                        <div class="form-group">
                                            <label for="nome">Nome</label>
                                            <input type="text" class="form-control" id="nome" name="nome" value="{{ $colaborador->nome }}" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="email">Email</label>
                                            <input type="email" class="form-control" id="email" name="email" value="{{ $colaborador->email }}" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="cpf">CPF</label>
                                            <input type="text" class="form-control" id="cpf" name="cpf" value="{{ $colaborador->cpf }}" required>
                                        </div>
                                        <div class="col-md-3 mb-3">
                                            <label for="unidade" class="form-label fw-bold">
                                                <i class="fas fa-building"></i> Unidade:
                                            </label>
                                            <select name="unidade_id" id="unidade_id" class="form-control select2bs4 border-primary shadow-sm" required>
                                                <option value="" disabled selected>Selecione uma Unidade...</option>
                                                @foreach($unidades as $uni)
                                                <option value="{{ $uni->id }}" @if($colaborador->unidade_id == $uni->id) selected @endif>
                                                    {{ $uni->nome_fantasia }}
                                                </option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <button type="submit" class="btn btn-primary">Editar</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@include('layouts.footer')