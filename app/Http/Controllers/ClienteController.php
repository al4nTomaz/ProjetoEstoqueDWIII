<?php

namespace App\Http\Controllers;
use App\Models\Cliente;
use Illuminate\Http\Request;

class ClienteController extends Controller
{
    // Exibe todos os clientes
    public function index()
    {
        $clientes = Cliente::all();
        return view('clientes.index', compact('clientes'));
    }

    // Exibe o formulário para criar um novo cliente
    public function create()
    {
        return view('clientes.create');
    }

    // Armazena um novo cliente
    public function store(Request $request)
    {

        $request->validate([
            'nome' => 'required',
            'cpf' => 'required|unique:clientes',
            'telefone' => 'required',
            'email' => 'required|email',
        ]);

        Cliente::create($request->all());

        return redirect()->route('clientes.index')
                         ->with('success', 'Cliente cadastrado com sucesso!');
    }

    // Exibe os detalhes de um cliente
    public function show(Cliente $cliente)
    {
        return view('clientes.show', compact('cliente'));
    }

    // Exibe o formulário de edição de um cliente
    public function edit(Cliente $cliente)
    {
        return view('clientes.edit', compact('cliente'));
    }

    // Atualiza os dados de um cliente
    public function update(Request $request, Cliente $cliente)
    {
        $request->validate([
            'nome' => 'required',
            'cpf' => 'required|unique:clientes,cpf,' . $cliente->id,
            'telefone' => 'required',
            'email' => 'required|email',
        ]);

        $cliente->update($request->all());

        return redirect()->route('clientes.index')
                         ->with('success', 'Cliente atualizado com sucesso!');
    }

    // Exclui um cliente
    public function destroy(Cliente $cliente)
    {
        $cliente->delete();

        return redirect()->route('clientes.index')
                         ->with('success', 'Cliente excluído com sucesso!');
    }

}
