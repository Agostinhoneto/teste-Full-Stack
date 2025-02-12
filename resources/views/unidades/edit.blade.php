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
                                <h3 class="card-title">Formulário de Edição Unidades</h3>
                            </div>
                            <div class="card-body">
                                <form action="{{ route('unidades.update',$unidade->id)}}" method="POST">
                                    @csrf
                                    @method('PUT')
                                    <div class="mb-3">
                                        <div class="form-group">
                                            <label for="nome_fantasia">Nome Fantasia</label>
                                            <input type="text" class="form-control" id="nome_fantasia" name="nome_fantasia" value="{{ $unidade->nome_fantasia }}" required>
                                        </div>

                                        <div class="form-group">
                                            <label for="razao_social">Razão Social</label>
                                            <input type="text" class="form-control" id="razao_social" name="razao_social" value="{{ $unidade->razao_social }}" required>
                                        </div>

                                        <div class="form-group">
                                            <label for="cnpj">CNPJ</label>
                                            <input type="text" class="form-control" id="cnpj" name="cnpj" value="{{ $unidade->cnpj }}" required>
                                        </div>
                                        <label for="grupo_economico" class="form-label fw-bold">
                                            <i class="fas fa-building"></i> Bandeira :
                                        </label>
                                        <select name="bandeira_id" id="bandeira_id" class="form-control select2bs4 border-primary shadow-sm" required>
                                            <option value="" disabled>Selecione uma Bandeira...</option>
                                            @foreach($bandeira as $b)
                                            <option value="{{ $b->id }}"
                                                @if($unidade->bandeira_id == $b->id) selected @endif>
                                                {{ $b->nome }}
                                            </option>
                                            @endforeach
                                        </select>
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
</div>
@include('layouts.footer')