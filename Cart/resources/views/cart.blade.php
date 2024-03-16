@extends('layouts.main')

@section('title', 'Carrinho')

@section('content')

<h1>Carrinho</h1>

<div class="cart-items" id="cart-items">
</div>
<div class="checkout-form">
    <label for="name">Nome:</label>
    <input type="text" id="name" name="name" required>

    <label for="address">Endereço:</label>
    <input type="text" id="address" name="address" required>

    <label for="payment">Meio de Pagamento:</label>
    <select id="payment" name="payment" required>
        <option value="credit">Cartão de Crédito</option>
        <option value="debit">Cartão de Débito</option>
    </select>

    <p>Total: R$ <span id="total-price">0.00</span></p>
    <button onclick="checkout()">Finalizar Compra</button>
</div>

@endsection