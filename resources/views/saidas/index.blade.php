<x-app-layout>
    <x-slot name="header">
        <div class="d-flex justify-content-between align-items-center">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                {{ __('Produtos Vendidos') }}
            </h2>
            <div class="text-right">
                <!-- Botão de Voltar para a Lista de Produtos -->
                <a href="{{ route('produtos.index') }}" class="btn btn-secondary" role="button">
                    <i class="fas fa-arrow-left"></i> Voltar para a Lista de Produtos
                </a>
            </div>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    @forelse($saidasProdutos as $saidaProduto)
                        <div class="card mb-4">
                            <div class="card-header bg-secondary text-black">
                                <a href="{{ route('saidas.show', $saidaProduto->id) }}"><h4>{{ $saidaProduto->produto->nome }}</h4></a>
                            </div>
                            <div class="card-body">
                                <p><strong>Cliente:</strong> {{ $saidaProduto->cliente->nome }}</p>
                                <p><strong>Quantidade:</strong> {{ $saidaProduto->quantidade }}</p>
                                <p><strong>Data da Saída:</strong> {{ $saidaProduto->created_at->format('d/m/Y H:i') }}</p>
                                <p><strong>Valor Total:</strong> R$ {{ number_format($saidaProduto->valor_total, 2, ',', '.') }}</p>
                                
                                @php
                                    // Gerar dados para o QR Code
                                    $qrCodeData = [
                                        'Data' => $saidaProduto->created_at->format('d/m/Y H:i'),
                                        'Valor Total' => 'R$ ' . number_format($saidaProduto->valor_total, 2, ',', '.'),
                                        'Quantidade' => $saidaProduto->quantidade,
                                    ];
                                    $qrCodePath = 'qr_codes/saida_' . $saidaProduto->id . '.svg';
                                @endphp

                                @if($saidaProduto->qr_code_path)
                                    <div class="mt-3">
                                        <strong>QR Code:</strong>
                                        <br>
                                        <img src="{{ asset($saidaProduto->qr_code_path) }}" width="150">
                                    </div>
                                @else
                                    <div class="mt-3">
                                        <strong>Gerar QR Code:</strong>
                                        <br>
                                        @php
                                            // Gerar o QR Code se não houver um existente
                                            \SimpleSoftwareIO\QrCode\Facades\QrCode::size(200)
                                                ->format('svg')
                                                ->generate(json_encode($qrCodeData), public_path($qrCodePath));
                                            // Atualizar o caminho do QR Code na saída
                                            $saidaProduto->update(['qr_code_path' => $qrCodePath]);
                                        @endphp
                                        <img src="{{ asset($qrCodePath) }}" width="150">
                                    </div>
                                @endif
                            </div>
                        </div>
                    @empty
                        <p>Não há saídas registradas.</p>
                    @endforelse
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
