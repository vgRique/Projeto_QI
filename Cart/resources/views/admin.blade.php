@extends('layouts.main')

@section('title', 'Administração')

@section('content')

<h1>Administração</h1>

<div id="product-form">
    <h2>Adicionar/Editar Produto</h2>
    <label for="product-name">Nome do Produto:</label>
    <input type="text" id="product-name" required>

    <label for="product-price">Preço do Produto (R$):</label>
    <input type="number" id="product-price" step="0.01" required>

    <label for="product-category">Categoria do Produto:</label>
    @csrf
    <select id="product-category" required>
        <option value="cervejas">Cervejas</option>
        <option value="refrigerantes">Refrigerantes</option>
        <option value="aguas">Águas</option>
        <!-- Adicione mais categorias conforme necessário -->
    </select>
    <input type="file" name="imagem" id="imagem">
    <input type="submit" value="Enviar Imagem" name="submit">

    <button onclick="saveProduct()">Salvar Produto</button>
</div>

<script>
        function saveProduct() {
            var name = document.getElementById('product-name').value;
            var price = document.getElementById('product-price').value;
            var category = document.getElementById('product-category').value;
            var imagem = document.getElementById('imagem').files[0];
            //var csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
            var csrfToken = "{{ csrf_token() }}";


            var formData = new FormData();
            formData.append('nome', name);
            formData.append('preco', price);
            formData.append('categoria', category);
            formData.append('imagem', imagem);
            formData.append('_token', csrfToken);

            var xhr = new XMLHttpRequest();
            xhr.open('POST', '/products', true);
            xhr.onreadystatechange = function () {
                if (xhr.readyState === 4 && xhr.status === 201) {
                    alert('Produto adicionado com sucesso!');
                }
            };
            xhr.send(formData);
        }
    </script>

<div id="admin-product-list">
    <!-- Produtos administrativos serão exibidos aqui -->
</div>

@endsection