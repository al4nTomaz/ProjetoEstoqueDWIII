<head>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
</head>
<x-app-layout>
    <x-slot name="header">
    <div class="d-flex justify-content-between align-items-center">
         <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Cadastro de Produtos') }}
        </h2>
            <a href="/produtos"><button class="btn btn-primary btn-lg">Listar Produtos</button></a>
</div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg" style="border:solid 1px black;">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                <div class="form-container">
                <form action="{{ route('produtos.store') }}" method="POST" class="container mt-4" enctype="multipart/form-data">
                        @csrf
                        <div style="padding:15px">
                            <h3 class="text-center font-weight-bold mt-4 mb-4">Cadastro de Produto</h3>
                            
                            <!-- Nome do Produto -->
                            <div class="form-group">
                                <label for="nome">Nome do Produto</label>
                                <input type="text" id="nome" name="nome" class="form-control" required>
                            </div>

                            <!-- Imagem do Produto -->
                            <div class="form-group">
                                <label for="imagem">Imagem do Produto</label>
                                <img id="imagemPreview" src="#" alt="Imagem do Produto" style="max-width: 350px; display: none; margin-top: 10px; margin:0 auto;">
                                <input type="file" id="imagem" name="imagem" class="form-control-file" onchange="ImagemPreview(event)" required>
                            </div>

                            <!-- Quantidade em Estoque -->
                            <div class="form-group">
                                <label for="estoque">Quantidade em Estoque</label>
                                <input type="number" id="estoque" name="estoque" class="form-control" required>
                            </div>

                            <!-- Descrição -->
                            <div class="form-group">
                                <label for="descricao">Descrição</label>
                                <textarea id="descricao" name="descricao" class="form-control" required></textarea>
                            </div>

                            <!-- Valor Unitário, usei number aplicando o step de 1 em 1 centavo. Aceita com , e com . -->
                            <div class="form-group">
                                <label for="valor_unitario">Valor Unitário</label>
                                <input type="number" id="valor_unitario" name="valor_unitario" class="form-control" step="0.01" required>
                            </div>

                            <!-- Unidade de Medida -->
                            <div class="form-group">
                                <label for="id_unidade">Unidade de Medida</label>
                                <select id="id_unidade" name="id_unidade" class="form-control" required>
                                    @foreach($unidades as $unidade)
                                        <option value="{{ $unidade->id }}">{{ $unidade->sigla }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <!-- Categoria -->
                            <div class="form-group">
                                <label for="id_categoria">Categoria</label>
                                <select id="id_categoria" name="id_categoria" class="form-control" required>
                                    @foreach($categorias as $categoria)
                                        <option value="{{ $categoria->id }}">{{ $categoria->nome }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <!-- Botão de Submit -->
                            <div class="text-center">
                                <button type="submit" class="btn btn-primary btn-lg">Cadastrar</button>
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
            output.src = reader.result;
            output.style.display = 'block';  // Exibe a imagem
        };
        reader.readAsDataURL(event.target.files[0]);
    }
</script>