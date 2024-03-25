@extends('layouts.main')

@section('title', 'Carrinhho de compras')

@section('content')

@if(session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@endif

<h1>Listagem de produtos</h1>

<div class="filter-buttons">
    <button onclick="filterByCategory('cervejas')">Cervejas</button>
    <button onclick="filterByCategory('refrigerantes')">Refrigerantes</button>
    <button onclick="filterByCategory('aguas')">Águas</button>
    <button onclick="clearFilters()">Limpar Filtros</button>
    <!-- Adicione mais botões de filtro conforme necessário -->
</div>



<div class="card">
    @foreach($products as $product)
    
    <div class="drink-card" data-category="{{ $product->categoria }}">
        <img src="/storage{{ Str::after($product->imagem, 'public') }}" alt="{{ $product->nome }}">
        <h2>{{ $product->nome }}</h2>
        <p>R${{ $product->preco }}</p>
        <div id="{{ $product->nome }}-details" class="details" style="display: none;">
            <p>Descrição:</p>
            <p>{{ $product->descricao }}</p>
            <button onclick="toggleDetails('{{ $product->nome }}-details')">Fechar</button>
            <!-- Adicione mais detalhes conforme necessário -->
        </div>
        <button onclick="addToCart({{ $product->id }})">Adicionar ao Carrinho</button>
    </div>
    @endforeach
</div>


<script>
        function addToCart(id) {
            var csrfToken = "{{ csrf_token() }}";


            var formData = new FormData();
            formData.append('id', id);
            formData.append('_token', csrfToken);

            var xhr = new XMLHttpRequest();
            xhr.open('POST', '/cart/add/', true);
            
            xhr.send(formData);
        }
</script>


@endsection