<head>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
</head>

<x-app-layout>
    
    <x-slot name="header">
        <div class="d-flex justify-content-between align-items-center">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                {{ __('Lista de Produtos') }}
            </h2>
            <a href="{{ route('produtos.create') }}"><button class="btn btn-primary">Cadastrar Produto</button></a>
        </div>
    </x-slot>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                <input type="text" id="buscaInput" placeholder="Digite um nome..." oninput="buscar()">
                <button id="buscarButton" onclick="buscar()">Buscar</button>
                    <div class="form-container">

                        <!-- Tabela de Produtos -->
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Nome</th>
                                    <th>Categoria</th>
                                    <th>Unidade</th>
                                    <th>Estoque</th>
                                    <th>Valor Unitário</th>
                                    <th>Ações</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($produtos as $produto)
                                    <tr>
                                        <td>{{ $produto->id }}</td>
                                        <td>{{ $produto->nome }}</td>
                                        <td>{{ $produto->categoria->nome ?? 'Sem Categoria' }}</td>  
                                        <td>{{ $produto->unidade->sigla ?? 'Sem Unidade' }}</td>  
                                        <td>{{ $produto->estoque }}</td>
                                        <td>{{ number_format($produto->valor_unitario, 2, ',', '.') }}</td>
                                        <td>
                                            <a href="{{ route('produtos.show', $produto->id) }}" class="btn btn-info btn-sm">
                                                <i class="fas fa-search"></i> Visualizar
                                            </a>
                                            <a href="{{ route('produtos.edit', $produto->id) }}" class="btn btn-warning btn-sm">
                                                <i class="fas fa-pencil-alt"></i> Editar
                                            </a>
                                            <form action="{{ route('produtos.destroy', $produto->id) }}" method="POST" style="display:inline-block;">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger btn-sm">
                                                    <i class="fas fa-trash-alt"></i> Excluir
                                                </button>
                                            </form>
                                            <!-- Botão de Venda -->
                                            <a href="{{ route('saidas.create', ['produto_id' => $produto->id]) }}" class="btn btn-success btn-sm">
                                                <i class="fas fa-shopping-cart"></i> Vender
                                            </a>

                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>

                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="/js/buscar.js"></script>
</x-app-layout>
