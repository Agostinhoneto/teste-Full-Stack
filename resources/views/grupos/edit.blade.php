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
                                <h3 class="card-title">Formulário de Edição Grupo Econômico</h3>
                            </div>
                            <div class="card-body">
                                <form action="{{ route('grupo-economico.update',$grupoEconomico->id)}}"  method="POST">
                                    @csrf
                                    @method('PUT')
                                    <div class="mb-3">
                                        <div class="form-group">
                                            <label for="nome">Nome</label>
                                            <input type="text" class="form-control" id="nome" name="nome" value="{{ $grupoEconomico->nome }}" required>
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