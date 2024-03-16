@extends('layouts.main')

@section('title', 'Carrinhho de compras')

@section('content')

<h1>Listagem de produtos</h1>

<div class="filter-buttons">
    <button onclick="filterByCategory('cervejas')">Cervejas</button>
    <button onclick="filterByCategory('refrigerantes')">Refrigerantes</button>
    <button onclick="filterByCategory('aguas')">Águas</button>
    <button onclick="clearFilters()">Limpar Filtros</button>
    <!-- Adicione mais botões de filtro conforme necessário -->
</div>

<div class="card">
    <div class="drink-card" data-category="cervejas">
        <img src="/img/cerveja.png" alt="Heineken">
        <h2>Heineken</h2>
        <p>Cerveja premium de alta qualidade.</p>
        <div id="cerveja-details" class="details" style="display: none;">
            <p>Descrição:</p>
            <p>Heineken lata 473ml.</p>
            <button onclick="toggleDetails('cerveja-details')">Fechar</button>
            <!-- Adicione mais detalhes conforme necessário -->
        </div>
        <button onclick="addToCart('Heineken', 10.00, 'Cerveja Heineken adicionada ao carrinho com sucesso!', '/img/cerveja.png')">Adicionar ao Carrinho</button>
    </div>

    <div class="drink-card" data-category="refrigerantes">
        <img src="/img/refrigerante.png" alt="Coca-Cola">
        <h2>Coca-Cola</h2>
        <p>Refrigerante refrescante e saboroso.</p>
        <div id="refrigerante-details" class="details" style="display: none;">
            <p>Descrição:</p>
            <p>Coca-cola lata de 350ml.</p>
            <button onclick="toggleDetails('refrigerante-details')">Fechar</button>
            <!-- Adicione mais detalhes conforme necessário -->
        </div>
        <button onclick="addToCart('Coca-Cola', 5.00, 'Refrigerante Coca-Cola adicionado ao carrinho com sucesso!', '/img/refrigerante.png')">Adicionar ao Carrinho</button>
    </div>

    <div class="drink-card" data-category="aguas">
        <img src="/img/agua.png" alt="Água Mineral">
        <h2>Água Mineral</h2>
        <p>Água pura e cristalina.</p>
        <div id="agua-details" class="details" style="display: none;">
            <p>Descrição:</p>
            <p>Água de 500ml sem gás.</p>
            <button onclick="toggleDetails('agua-details')">Fechar</button>
            <!-- Adicione mais detalhes conforme necessário -->
        </div>
        <button onclick="addToCart('Água Mineral', 2.50, 'Água Mineral adicionada ao carrinho com sucesso!', '/img/agua.png')">Adicionar ao Carrinho</button>
    </div>
    <!-- Adicione detalhes para outros produtos -->
</div>

@endsection