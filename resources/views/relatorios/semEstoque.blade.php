<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Relatório de Produtos Sem Estoque') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <h4>Produtos Sem Estoque</h4>
                    
                    @if($produtos->isEmpty())
                        <p>Não há produtos sem estoque.</p>
                    @else
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>Nome do Produto</th>
                                    <th>Categoria</th>
                                    <th>Unidade</th>
                                    <th>Estoque Atual</th>
                                    <th>Valor Unitário</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($produtos as $produto)
                                    <tr>
                                        <td>{{ $produto->nome }}</td>
                                        <td>{{ $produto->categoria->nome }}</td>
                                        <td>{{ $produto->unidade->nome }}</td>
                                        <td>{{ $produto->estoque }}</td>
                                        <td>{{ number_format($produto->valor_unitario, 2, ',', '.') }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
