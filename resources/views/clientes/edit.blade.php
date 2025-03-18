<head>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
    <script src="\js\cep.js"></script>
</head>

<x-app-layout>
    <x-slot name="header">
        <div class="d-flex justify-content-between align-items-center">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            <i class="fas fa-pencil-alt"></i>  Editar Cliente {{ $cliente->nome }}
            </h2>
            <a href="{{ route('clientes.index') }}"><button class="btn btn-info">Voltar</button></a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <div class="form-container">
                        <div class="container">

                            <form action="{{ route('clientes.update', $cliente) }}" method="POST">
                                @csrf
                                @method('PUT')

                                <!-- Dados Pessoais -->
                                <h3 class="text-center font-weight-bold mt-4 mb-4">Dados Pessoais</h3>

                                <div class="form-group">
                                    <label for="nome">Nome</label>
                                    <input type="text" id="nome" name="nome" class="form-control" value="{{ $cliente->nome }}" required>
                                </div>

                                <div class="form-group">
                                    <label for="cpf">CPF</label>
                                    <input type="text" id="cpf" name="cpf" class="form-control" value="{{ $cliente->cpf }}" required>
                                </div>

                                <div class="form-group">
                                    <label for="telefone">Telefone</label>
                                    <input type="text" id="telefone" name="telefone" class="form-control" value="{{ $cliente->telefone }}" required>
                                </div>

                                <div class="form-group">
                                    <label for="email">E-mail</label>
                                    <input type="email" id="email" name="email" class="form-control" value="{{ $cliente->email }}" required>
                                </div>

                                <!-- Endereço -->
                                <h3 class="text-center font-weight-bold mt-4 mb-4">Endereço</h3>

                                <div class="form-group row">
                                    <!-- CEP -->
                                    <div class="col-md-3">
                                        <label for="cep">CEP</label>
                                        <input name="cep" type="text" id="cep" class="form-control" value="{{ $cliente->cep }}" size="10" maxlength="9" onblur="pesquisacep(this.value);">
                                    </div>

                                    <!-- Cidade -->
                                    <div class="col-md-6">
                                        <label for="cidade">Cidade</label>
                                        <input type="text" id="cidade" name="cidade" class="form-control" value="{{ $cliente->cidade }}">
                                    </div>

                                    <!-- UF -->
                                    <div class="col-md-3">
                                        <label for="uf">UF</label>
                                        <input type="text" id="uf" name="uf" class="form-control" value="{{ $cliente->uf }}">
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <!-- Rua -->
                                    <div class="col-md-9">
                                        <label for="rua">Rua</label>
                                        <input type="text" id="rua" name="rua" class="form-control" value="{{ $cliente->rua }}">
                                    </div>

                                    <!-- Número -->
                                    <div class="col-md-3">
                                        <label for="numero">Nº</label>
                                        <input type="text" id="numero" name="numero" class="form-control" value="{{ $cliente->numero }}">
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <!-- Bairro -->
                                    <div class="col-md-6">
                                        <label for="bairro">Bairro</label>
                                        <input type="text" id="bairro" name="bairro" class="form-control" value="{{ $cliente->bairro }}">
                                    </div>

                                    <!-- Complemento -->
                                    <div class="col-md-6">
                                        <label for="complemento">Complemento</label>
                                        <input type="text" id="complemento" name="complemento" class="form-control" value="{{ $cliente->complemento }}">
                                    </div>
                                </div>

                                <div class="text-center">
                                    <button type="submit" class="btn btn-success btn-lg">Atualizar</button>
                                </div>

                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
