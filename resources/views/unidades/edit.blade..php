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
                                <h3 class="card-title">Formulário de Edição</h3>
                            </div>
                            <div class="card-body">
                                <form action="{{ route('bandeira.update',$bandeira->id)}}">
                                    @csrf
                                    @method('POST')
                                    <div class="mb-3">
                                        <div class="form-group">
                                            <label for="nome">Nome</label>
                                            <input type="text" class="form-control" id="nome" name="nome" value="{{ $bandeira->nome }}" required>
                                        </div>
                                        <label for="grupo_economico" class="form-label fw-bold">
                                            <i class="fas fa-building"></i> Grupo Econômico:
                                        </label>
                                        <select name="grupo_economico_id" id="grupo_economico" class="form-control select2bs4 border-primary shadow-sm" required>
                                            <option value="" disabled>Selecione um grupo econômico...</option>
                                            @foreach($grupos as $g)
                                            <option value="{{ $g->id }}"
                                                @if($bandeira->grupo_economico_id == $g->id) selected @endif>
                                                {{ $g->nome }}
                                            </option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <button type="submit" class="btn btn-primary">Salvar</button>
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