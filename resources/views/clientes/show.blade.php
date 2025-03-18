<head>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
</head>

<x-app-layout>
    <x-slot name="header">
    <div class="d-flex justify-content-between align-items-center">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            Detalhes do Cliente {{$cliente->nome}}
        </h2>
        <a href="{{ route('clientes.index') }}"><button class="btn btn-info">Voltar para a Lista</button></a>
</div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100 text-lg" >
                    <div class="form-container">
                        <!-- Exibindo os detalhes do cliente -->
                        <div class="mb-4">
                            <h3><strong>Nome:</strong> {{ $cliente->nome }}</h3>
                            <p><strong>CPF:</strong> {{ $cliente->cpf }}</p>
                            <p><strong>Telefone:</strong> {{ $cliente->telefone }}</p>
                            <p><strong>E-mail:</strong> {{ $cliente->email }}</p>

                            <h3 class="mt-4">Endereço</h3>
                            <p><strong>CEP:</strong> {{ $cliente->cep }}</p>
                            <p><strong>Rua:</strong> {{ $cliente->rua }}</p>
                            <p><strong>Bairro:</strong> {{ $cliente->bairro }}</p>
                            <p><strong>Cidade:</strong> {{ $cliente->cidade }}</p>
                            <p><strong>UF:</strong> {{ $cliente->uf }}</p>
                            <p><strong>Complemento:</strong> {{ $cliente->complemento }}</p>

                            <div class="mt-4">
                                            <a href="{{ route('clientes.edit', $cliente->id) }}" class="btn btn-warning btn-lg">
                                            <i class="fas fa-pencil-alt"></i> Editar</a>
                                            <form action="{{ route('clientes.destroy', $cliente->id) }}" method="POST" style="display:inline-block;">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger btn-lg"><i class="fas fa-trash-alt"></i>Excluir</button>
                                            </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
