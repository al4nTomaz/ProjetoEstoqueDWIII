<head>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
</head>

<x-app-layout>
    <x-slot name="header">
    <div class="d-flex justify-content-between align-items-center">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            Detalhes do Produto [{{$produto->nome}}]
        </h2>
        <a href="/produtos"><button class="btn btn-info">Voltar para a Lista</button></a>
    </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100 text-lg">
                    <div class="form-container">
                        <!-- Exibindo os detalhes do produto -->
                        <div class="row">
                            <!-- Coluna para a imagem do produto -->
                            <div class="col-md-6 text-center">
                                <img src="{{ asset('img/produtos/'.$produto->imagem) }}" alt="Imagem do Produto" class="img-fluid" style="max-width: 450px;">
                            </div>
                            
                            <!-- Coluna para os detalhes do produto -->
                            <div class="col-md-6">
                                <div class="mb-4">
                                    <h3><strong>Nome:</strong> {{ $produto->nome }}</h3>
                                    <p><strong>Estoque:</strong> {{ $produto->estoque }}</p>
                                    <p><strong>Descrição:</strong> {{ $produto->descricao }}</p>
                                    <p><strong>Valor Unitário:</strong> R$ {{ number_format($produto->valor_unitario, 2, ',', '.') }}</p>
                                    <p><strong>Unidade de Medida:</strong> {{ $produto->unidade->sigla }}</p>
                                    <p><strong>Categoria:</strong> {{ $produto->categoria->nome }}</p>

                                    <div class="mt-4">
                                        <a href="{{ route('produtos.edit', $produto->id) }}" class="btn btn-warning btn-lg">
                                            <i class="fas fa-pencil-alt"></i> Editar</a>
                                        <form action="{{ route('produtos.destroy', $produto->id) }}" method="POST" style="display:inline-block;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger btn-lg"><i class="fas fa-trash-alt"></i>Excluir</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div> <!-- Fim do row -->
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
