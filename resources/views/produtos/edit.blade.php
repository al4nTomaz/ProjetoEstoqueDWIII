<head>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
</head>
<x-app-layout>
    <x-slot name="header">
    <div class="d-flex justify-content-between align-items-center">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            <i class="fas fa-pencil-alt"></i>  Editar Produto [{{ $produto->nome }}]
            </h2>
            <a href="/produtos"><button class="btn btn-info">Voltar</button></a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg" style="border:solid 1px black;">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <div class="form-container">
                        <!-- Formulário de Edição de Produto -->
                        <form action="{{ route('produtos.update', $produto) }}" method="POST" class="container mt-4" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')  <!-- Método PUT para edição -->

                            <div style="padding:15px">
                                <h3 class="text-center font-weight-bold mt-4 mb-4">Editar Produto</h3>

                                <!-- Nome do Produto -->
                                <div class="form-group">
                                    <label for="nome">Nome do Produto</label>
                                    <input type="text" id="nome" name="nome" class="form-control" value="{{ old('nome', $produto->nome) }}" required>
                                </div>

                                <!-- Imagem do Produto -->
                                <div class="form-group">
                                    <label for="imagem">Imagem do Produto</label>
                                    <img id="imagemPreview" src="{{ asset('img/produtos/'.$produto->imagem) }}" alt="Imagem do produto" class="mt-2" style="max-width: 200px; margin:0 auto;">
                                    <input type="file" id="imagem" name="imagem" class="form-control-file" onChange="ImagemPreview(event)">
                                    <!-- Exibir imagem atual, caso exista -->
                                </div>

                                <!-- Quantidade em Estoque -->
                                <div class="form-group">
                                    <label for="estoque">Quantidade em Estoque</label>
                                    <input type="number" id="estoque" name="estoque" class="form-control" value="{{ old('estoque', $produto->estoque) }}" required>
                                </div>

                                <!-- Descrição -->
                                <div class="form-group">
                                    <label for="descricao">Descrição</label>
                                    <textarea id="descricao" name="descricao" class="form-control" required>{{ old('descricao', $produto->descricao) }}</textarea>
                                </div>

                                <!-- Valor Unitário -->
                                <div class="form-group">
                                    <label for="valor_unitario">Valor Unitário</label>
                                    <input type="number" id="valor_unitario" name="valor_unitario" class="form-control" step="0.01" value="{{ old('valor_unitario', $produto->valor_unitario) }}" required>
                                </div>

                                <!-- Unidade de Medida -->
                                <div class="form-group">
                                    <label for="id_unidade">Unidade de Medida</label>
                                    <select id="id_unidade" name="id_unidade" class="form-control" required>
                                        @foreach($unidades as $unidade)
                                            <option value="{{ $unidade->id }}" {{ $unidade->id == $produto->id_unidade ? 'selected' : '' }}>
                                                {{ $unidade->sigla }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>

                                <!-- Categoria -->
                                <div class="form-group">
                                    <label for="id_categoria">Categoria</label>
                                    <select id="id_categoria" name="id_categoria" class="form-control" required>
                                        @foreach($categorias as $categoria)
                                            <option value="{{ $categoria->id }}" {{ $categoria->id == $produto->id_categoria ? 'selected' : '' }}>
                                                {{ $categoria->nome }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>

                                <!-- Botão de Submit -->
                                <div class="text-center">
                                    <button type="submit" class="btn btn-primary btn-lg">Atualizar Produto</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
<script>
    function ImagemPreview(event) {
        var reader = new FileReader();
        reader.onload = function() {
            var output = document.getElementById('imagemPreview');
            output.src = reader.result;  // Substitui a imagem atual pela imagem escolhida
        };
        reader.readAsDataURL(event.target.files[0]);  // Lê o arquivo selecionado
    }
</script>
