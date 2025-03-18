<?php

namespace App\Http\Controllers;

use App\Models\Produto;
use App\Models\Categoria;
use App\Models\Unidade;
use Illuminate\Http\Request;

class ProdutoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $produtos = Produto::with(['categoria', 'unidade'])->get();
        return view('produtos.index', compact('produtos'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categorias = Categoria::all();
        $unidades = Unidade::all();
        return view('produtos.create', compact('categorias', 'unidades'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nome' => 'required|string|max:255',
            'imagem' => 'required|image|max:2048',  // Validação para imagem
            'estoque' => 'required|integer',
            'descricao' => 'required|string',
            'valor_unitario' => 'required|numeric',
            'id_unidade' => 'required|exists:unidades,id', // A unidade deve existir
            'id_categoria' => 'required|exists:categorias,id', // A categoria deve existir
        ]);

        $dados = $request->all();

        if($request->hasFile('imagem')&& $request->file('imagem')->isValid()){
            $requestImagem = $request->file('imagem');
            $extensao = $requestImagem->extension();
            $nomeImagem = md5($requestImagem->getClientOriginalName().strtotime("now")).'.'.$extensao;
            $request->imagem->move(public_path('img/produtos'),$nomeImagem);
            $dados['imagem'] = $nomeImagem;
        }
        else{
            $dados['imagem'] = "nulo.jpg";
        }

        Produto::create($dados);

        return redirect()->route('produtos.index')
                        ->with('success', 'Produto cadastrado com sucesso!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Produto $produto)
    {
        return view('produtos.show', compact('produto'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Produto $produto)
    {
        $categorias = Categoria::all();
        $unidades = Unidade::all();
       // $produto = Produto::with(['categoria', 'unidade'])->get();
        return view('produtos.edit', compact('produto','categorias','unidades'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Produto $produto)
    {
        $request->validate([
            'nome' => 'required|string|max:255',
            'imagem' => 'nullable|image|max:2048',  // Validação para imagem
            'estoque' => 'required|integer',
            'descricao' => 'required|string',
            'valor_unitario' => 'required|numeric',
            'id_unidade' => 'required|exists:unidades,id', // A unidade deve existir
            'id_categoria' => 'required|exists:categorias,id', // A categoria deve existir
        ]);

        $dados = $request->all();

        if($request->hasFile('imagem')&& $request->file('imagem')->isValid()){
            if ($produto->imagem && file_exists(public_path('img/produtos/' . $produto->imagem))) {
                unlink(public_path('img/produtos/' . $produto->imagem));
            }

            $requestImagem = $request->file('imagem');
            $extensao = $requestImagem->extension();
            $nomeImagem = md5($requestImagem->getClientOriginalName().strtotime("now")).'.'.$extensao;
            $request->imagem->move(public_path('img/produtos'),$nomeImagem);
            $dados['imagem'] = $nomeImagem;
        }
        else{
            // Caso não envie uma nova imagem, mantém a imagem antiga
            $dados['imagem'] = $produto->imagem;
        }

        $produto->update($dados);

        return redirect()->route('produtos.index')
                         ->with('success', 'Produto atualizado com sucesso!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Produto $produto)
    {
            // Verificar se o produto tem uma imagem associada e excluir a imagem
            if ($produto->imagem && $produto->imagem != 'nulo.jpg') {
                // Defina o caminho completo da imagem
                $caminhoImagem = public_path('img/produtos/' . $produto->imagem);

                // Verifique se o arquivo existe e exclua
                if (file_exists($caminhoImagem)) {
                    unlink($caminhoImagem);
                }
            }
        
        $produto->delete();

        return redirect()->route('produtos.index')
                         ->with('success', 'Produto excluído com sucesso!');
    }
}
