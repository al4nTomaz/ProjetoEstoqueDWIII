<head>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <script src="\js\cep.js"></script>
</head>
<x-app-layout>
    <x-slot name="header">
    <div class="d-flex justify-content-between align-items-center">
         <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Cadastro de Clientes') }}
        </h2>
            <a href="/clientes"><button class="btn btn-primary btn-lg">Listar Clientes</button></a>
</div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg" style="border:solid 1px black;">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                <div class="form-container">
                <form action="{{ route('clientes.store') }}" method="POST" id="formCadastro" class="container mt-4" >
                    @csrf
                <div style="border:solid 1px black;padding:15px">
                        <h3 class="text-center font-weight-bold mt-4 mb-4">Dados Pessoais</h3>
                        <!-- Nome -->
                        <div class="form-group">
                            <label for="nome">Nome</label>
                            <input type="text" id="nome" name="nome" class="form-control" required>
                        </div>

                        <!-- CPF -->
                        <div class="form-group">
                            <label for="cpf">CPF</label>
                            <input type="text" id="cpf" name="cpf" class="form-control" required>
                        </div>

                        <!-- Telefone -->
                        <div class="form-group">
                            <label for="telefone">Telefone</label>
                            <input type="text" id="telefone" name="telefone" class="form-control" required>
                        </div>

                        <!-- E-mail -->
                        <div class="form-group">
                            <label for="email">E-mail</label>
                            <input type="email" id="email" name="email" class="form-control" required>
                        </div>
       
                   
                        <h3 class="text-center font-weight-bold mt-4 mb-4">Endereço</h3>

                        <!-- CEP -->
              
                        <div class="form-group row">
                        
                        <div class="col-md-3">
                            <label for="cep">CEP</label>
                            <input name="cep" type="text" id="cep" class="form-control" value="" size="10" maxlength="9" onblur="pesquisacep(this.value);">
                        </div>

                            <!-- Cidade -->
                            <div class="col-md-6">
                                <label for="cidade">Cidade</label>
                                <input type="text" id="cidade" name="cidade" class="form-control">
                            </div>

                            <!-- UF -->
                            <div class="col-md-3">
                                <label for="uf">UF</label>
                                <input type="text" id="uf" name="uf" class="form-control">
                            </div>
                        </div>

                        <div class="form-group row">

                            <!-- Rua -->
                            <div class="col-md-9">
                                <label for="rua">Rua</label>
                                <input type="text" id="rua" name="rua" class="form-control">
                            </div>

                            <!-- Número -->
                            <div class="col-md-3">
                                <label for="numero">Nº</label>
                                <input type="text" id="numero" name="numero" class="form-control">
                            </div>
                        </div>
                        <div class="form-group row">
                            <!-- Bairro -->
                            <div class="col-md-6">
                                <label for="bairro">Bairro</label>
                                <input type="text" id="bairro" name="bairro" class="form-control">
                            </div>

                            <!-- Complemento -->
                            <div class="col-md-6">
                                <label for="complemento">Complemento</label>
                                <input type="text" id="complemento" name="complemento" class="form-control">
                            </div>
                        </div>
                  
                        <div class="text-center">
                            <input type="submit" class="btn btn-primary btn-lg" value="Cadastrar">
                        </div><!-- Botão de Submit -->
                    </form>
                </div> 
                </div>
            </div>
        </div>
    </div>
</x-app-layout>