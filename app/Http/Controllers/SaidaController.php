<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Produto;
use App\Models\Saida;
use App\Models\Cliente;
use Illuminate\Support\Facades\DB;
use SimpleSoftwareIO\QrCode\Facades\QrCode;
use Carbon\Carbon;


class SaidaController extends Controller
{
    public function index()
    {
        // Busca todas as saídas de produtos com os dados do cliente e produto
        $saidasProdutos = Saida::with(['cliente', 'produto'])->latest()->get(); // Traz todas as saídas de produtos
        return view('saidas.index', compact('saidasProdutos')); // Passa para a view
    }


    public function create(Request $request)
    {
        $produto = Produto::findOrFail($request->produto_id);
        $clientes = Cliente::all();

        return view('saidas.create', compact('produto', 'clientes'));
    }

    public function store(Request $request)
    {
        $s = 0;
    // Validação dos dados
        $request->validate([
            'cliente_id' => 'required|exists:clientes,id',
            'produto_id' => 'required|exists:produtos,id',
            'quantidade' => 'required|integer|min:1',
        ]);

        DB::transaction(function () use ($request, &$saidaIds, &$qrData, &$s) {
            // Obtém o produto
            $produto = Produto::lockForUpdate()->findOrFail($request->produto_id);

            // Verifica se há estoque suficiente
            if ($request->quantidade > $produto->estoque) {
                throw new \Exception("Quantidade solicitada para o produto {$produto->nome} excede o estoque disponível.");
            }

            // Atualiza o estoque do produto
            $produto->decrement('estoque', $request->quantidade);

            // Registra a saída do produto
            $valor = ($produto->valor_unitario * $request->quantidade);
            $saida = Saida::create([
                'cliente_id' => $request->cliente_id,
                'produto_id' => $request->produto_id,
                'quantidade' => $request->quantidade,
                'valor_total' => $valor,
                'data_saida' => now(),
            ]);

            // Armazena o ID da saída
            $saidaIds[] = $saida->id;
            $s = $saida->id;
            // Dados para o QR Code
            $qrData[] = [
                'Saida ID' => $saida->id,
                'Cliente' => $saida->cliente->nome,
                'Produto' => $saida->produto->nome,
                'Quantidade' => $saida->quantidade,
                'Valor Total' => 'R$ ' . number_format($saida->valor_total, 2, ',', '.'),
                'Data' => Carbon::parse($saida->data_saida)->format('d/m/Y H:i'),
            ];

            // Geração de QR Code para a saída
            $qrCodeData = [
                'Saida ID' => $saida->id,
                'Cliente' => $saida->cliente->nome,
                'Produto' => $saida->produto->nome,
                'Quantidade' => $saida->quantidade,
                'Valor Total' => 'R$ ' . number_format($saida->valor_total, 2, ',', '.'),
                'Data' => Carbon::parse($saida->data_saida)->format('d/m/Y H:i'),
            ];

            // Definir o caminho para o QR Code
            $qrCodePath = 'qr_codes/saida_' . $saida->id . '.svg';

            // Gera o QR Code e salva como SVG
            QrCode::size(200)->format('svg')->generate(json_encode($qrCodeData), public_path($qrCodePath));

            // Atualiza o caminho do QR Code para a saída

            $saida->update(['qr_code_path' => $qrCodePath]);
            
        });
        return redirect()->route('saidas.show', ['saida' =>  $s])->with('success', 'Saída registrada com sucesso!');

        // Redireciona para a página de detalhes da saída (show) do produto que foi vendido
    }

    // public function store(Request $request)
    // {
    //     // Validação dos dados
    //     $request->validate([
    //         'cliente_id' => 'required|exists:clientes,id',
    //         'produto_id' => 'required|exists:produtos,id',
    //         'quantidade' => 'required|integer|min:1',
    //     ]);

    //     DB::transaction(function () use ($request, &$saidaIds, &$qrData) {
    //         // Obtém o produto
    //         $produto = Produto::lockForUpdate()->findOrFail($request->produto_id);
        
    //         // Verifica se há estoque suficiente
    //         if ($request->quantidade > $produto->estoque) {
    //             throw new \Exception("Quantidade solicitada para o produto {$produto->nome} excede o estoque disponível.");
    //         }
        
    //         // Atualiza o estoque do produto
    //         $produto->decrement('estoque', $request->quantidade);
        
    //         // Registra a saída do produto
    //         $valor = ($produto->valor_unitario * $request->quantidade);
    //         $saida = Saida::create([
    //             'cliente_id' => $request->cliente_id,
    //             'produto_id' => $request->produto_id,
    //             'quantidade' => $request->quantidade,
    //             'valor_total' => $valor,
    //             'data_saida' => now(),
    //         ]);
        
    //         // Armazena o ID da saída
    //         $saidaIds[] = $saida->id;
        
    //         // Dados para o QR Code
    //         $qrData[] = [
    //             'Saida ID' => $saida->id,
    //             'Cliente' => $saida->cliente->nome,
    //             'Produto' => $saida->produto->nome, // Ajustado para mostrar o nome do produto
    //             'Quantidade' => $saida->quantidade,
    //             'Valor Total' => 'R$ ' . number_format($saida->valor_total, 2, ',', '.'),
    //             'Data' => Carbon::parse($saida->data_saida)->format('d/m/Y H:i'),
    //         ];
        
    //         // Geração de QR Code para a saída
    //         $qrCodeData = [
    //             'Saida ID' => $saida->id,
    //             'Cliente' => $saida->cliente->nome,
    //             'Produto' => $saida->produto->nome, // Ajustado para mostrar o nome do produto
    //             'Quantidade' => $saida->quantidade,
    //             'Valor Total' => 'R$ ' . number_format($saida->valor_total, 2, ',', '.'),
    //             'Data' => Carbon::parse($saida->data_saida)->format('d/m/Y H:i'),
    //         ];
        
    //         // Definir o caminho para o QR Code
    //         $qrCodePath = 'qr_codes/saida_' . $saida->id . '.svg';
        
    //         // Gera o QR Code e salva como SVG
    //         QrCode::size(200)->format('svg')->generate(json_encode($qrCodeData), public_path($qrCodePath));
        
    //         // Atualiza o caminho do QR Code para a saída
    //         $saida->update(['qr_code_path' => $qrCodePath]);
            
    //     });
        

    //     // return view('saidas.show', compact('saida'));
    //     return redirect()->route('saidas.show', ['saida' => $saida->id])->with('success', 'Saída registrada com sucesso!');
    // }

    public function show(Saida $saida)
    {
        return view('saidas.show', compact('saida'));
    }
}
