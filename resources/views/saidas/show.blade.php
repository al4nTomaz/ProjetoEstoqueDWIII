<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            Detalhes da Saída de Produto
        </h2>
        <div class="text-right">
            <!-- Botão de Voltar para a Lista de Produtos -->
            <a href="{{ route('saidas.index') }}" class="btn btn-secondary" role="button">
                <i class="fas fa-arrow-left"></i> Voltar para a Lista de Saidas
            </a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg p-6">
                <p><strong>Cliente:</strong> {{ $saida->cliente->nome }}</p>

                <h4 class="mt-4"><strong>Produto Retirado:</strong></h4>
                <ul>
                    <li>
                        <p>
                            <strong>Produto:</strong> {{ $saida->produto->nome }}
                        </p>
                    </li>
                    <li>
                        <p>
                            <strong>Quantidade:</strong> {{ $saida->quantidade }}
                        </p>
                    </li>
                    <li>
                        <p><strong>Preço Unitário:</strong> R$ {{ number_format($saida->produto->valor_unitario, 2, ',', '.') }}</p>
                    </li>
                </ul>


                <p><strong>Valor Total:</strong> R$ {{ number_format($saida->valor_total, 2, ',', '.') }}</p>

                <h4 class="mt-4"><strong>QR Code:</strong></h4>
                @php
                // Gerar dados para o QR Code
                $qrCodeData = [
                'Data' => $saida->created_at->format('d/m/Y H:i'),
                'Valor Total' => 'R$ ' . number_format($saida->valor_total, 2, ',', '.'),
                'Quantidade' => $saida->quantidade,
                ];
                $qrCodePath = 'qr_codes/saida_' . $saida->id . '.svg';
                @endphp

                @if($saida->qr_code_path)
                <div class="mt-3">
                    
                    <img src="{{ asset($saida->qr_code_path) }}" width="150">
                </div>
                @else
                <div class="mt-3">
                    @php
                    // Gerar o QR Code se não houver um existente
                    \SimpleSoftwareIO\QrCode\Facades\QrCode::size(200)
                    ->format('svg')
                    ->generate(json_encode($qrCodeData), public_path($qrCodePath));
                    // Atualizar o caminho do QR Code na saída
                    $saida->update(['qr_code_path' => $qrCodePath]);
                    @endphp
                    <img src="{{ asset($qrCodePath) }}" width="150">
                </div>
                @endif
            </div>
        </div>
    </div>
</x-app-layout>