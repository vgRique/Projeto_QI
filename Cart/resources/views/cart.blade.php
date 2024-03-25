@extends('layouts.main')

@section('title', 'Carrinho')

@section('content')

<h1>Carrinho</h1>

@php
    $productCounts = [];
    $total = 0;
    if($cartItems){
    foreach($cartItems as $product){
            $productName = $product->nome;
            $productPreco = $product->preco;
            $productImagem = $product->imagem;

            if(!isset($productCounts[$productName])) {
                $productCounts[$productName][0] = 1;
                $productCounts[$productName][1] = $productName;
                $productCounts[$productName][2] = $productPreco;
                $productCounts[$productName][3] = $productImagem;
                $total += $productPreco;
                
                
                
            } else {
                $productCounts[$productName][0]++;
            }
        }
    }
    

@endphp

@if($productCounts)
@foreach($productCounts as $product)
    <div class="cart-product" >
            <div class="cart-item">
                <img src="/storage{{ Str::after($product[3], 'public') }}" alt="${product[1]}">
                <h2>{{ $product[1] }}</h2>
                <p>Preço: R$ ${{ $product[2] }} </p>
                <button onclick="decreaseQuantity('')">-</button>
                <span>{{ $product[0] }}</span>
                <button onclick="increaseQuantity()">+</button>
                <button onclick="removeOneFromCart()">Remover</button>
            </div>
    </div>
@endforeach
@else
<div class="cart-product" >


@if(session('success'))
    <div class="alert alert-success">
        <p>{{ session('success') }}</p>
    </div>
@endif
<p>Nenhum item no carrinho</p>
</div>
@endif

<form class="checkout-form" action="/comprar" method="POST">
    <label for="name">Nome:</label>
    <input type="text" id="name" name="name" required>

    <label for="address">Endereço:</label>
    <input type="text" id="address" name="address" required>

    @csrf
    <label for="payment">Meio de Pagamento:</label>
    <select id="payment" name="payment" required>
        <option value="credit">Cartão de Crédito</option>
        <option value="debit">Cartão de Débito</option>
    </select>

    <p>Total: R$ <span id="total-price">{{$total}}</span></p>
    <button type="submite" class="btn btn-primary">Finalizar Compra</button>
</form>


@endsection