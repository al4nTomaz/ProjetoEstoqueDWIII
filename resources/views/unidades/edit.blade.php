<head>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
    <script src="\js\cep.js"></script>
</head>

<x-app-layout>
    <x-slot name="header">
        <div class="d-flex justify-content-between align-items-center">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            <i class="fas fa-pencil-alt"></i>  Editar Unidade de Medida {{ $unidade->nome }}
            </h2>
            <a href="{{ route('unidades.index') }}"><button class="btn btn-info">Voltar</button></a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <div class="form-container">
                        <div class="container">

                            <form action="{{ route('unidades.update', $unidade) }}" method="POST">
                                @csrf
                                @method('PUT')

                                <div class="form-group">
                                    <label for="nome">Sigla</label>
                                    <input type="text" id="sigla" name="sigla" class="form-control" value="{{ $unidade->sigla }}" required>
                                </div>

                                <div class="form-group">
                                    <label for="descricao">Descrição</label>
                                    <input type="text" id="descricao" name="descricao" class="form-control" value="{{ $unidade->descricao }}" required>  
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
