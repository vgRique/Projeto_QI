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
    <select id="product-category" required>
        <option value="cervejas">Cervejas</option>
        <option value="refrigerantes">Refrigerantes</option>
        <option value="aguas">Águas</option>
        <!-- Adicione mais categorias conforme necessário -->
    </select>

    <button onclick="saveProduct()">Salvar Produto</button>
</div>

<div id="admin-product-list">
    <!-- Produtos administrativos serão exibidos aqui -->
</div>

@endsection