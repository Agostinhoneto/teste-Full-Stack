@if ($errors->any())
<div class="alert alert-danger">
    <ul>
        @foreach ($errors->all() as $error)
        <li>{{ $error }}</li>
        @endforeach
    </ul>
</div>
@endif
<div class="modal fade" id="myModal">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Criar Usuários</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card card-primary">
                            <br>
                            <form class="form" method="POST" action="{{ route('users.store') }}">
                                @csrf
                                <div class="col col-8">
                                    <x-label for="name" :value="__('Nome')" />
                                    <x-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required autofocus />
                                </div>
                                <br>
                                <div class="col col-8">
                                    <x-label for="email" :value="__('Email')" />

                                    <x-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required />
                                </div>
                                <br>
                                <div class="col col-8">
                                    <label for="exampleSelectBorder">Tipo</label>
                                    <select class="custom-select form-control-border" id="is_admin" name="is_admin">
                                        <option>Selecione</option>
                                        <option value="1">Administrador</option>
                                        <option value="2">Usuário</option>
                                    </select>
                                </div>
                                <br>
                                <div class="col col-8">
                                    <x-label for="password" :value="__('Senha')" />

                                    <x-input id="password" class="block mt-1 w-full"
                                        type="password"
                                        name="password"
                                        required autocomplete="new-password" />
                                </div>
                                <br>
                                <div class="col col-8">
                                    <x-label for="password_confirmation" :value="__('Confirmar Senha')" />

                                    <x-input id="password_confirmation" class="block mt-1 w-full"
                                        type="password"
                                        name="password_confirmation" required />
                                </div>
                                <br>
                                <div class="flex items-center justify-end mt-4">
                                    <x-button class="ml-4">
                                        {{ __('Salvar') }}
                                    </x-button>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
