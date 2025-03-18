<?php

namespace App\Http\Controllers;

use App\Models\Saida;
use App\Models\Produto;
use App\Models\Categoria;
use App\Models\Unidade;
use App\Models\Cliente;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class RelatorioController extends Controller
{
    public function index()
    {
        // Lógica para passar o período para a view
        return view('relatorios.index');
    }
    
    public function comEstoque(){
        $produtos = Produto::where('estoque', '>', 0)->get();
        // $produtos = Produto::all();

        return view('relatorios.comEstoque', compact('produtos'));

    }
    
    public function semEstoque(){
        $produtos = Produto::all();
        $produtos = Produto::where('estoque', 0)->get();
        return view('relatorios.semEstoque', compact('produtos'));
        
    }
}
