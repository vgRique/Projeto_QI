<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CarrinhoController extends Controller
{
    public function carrinho() {

        $cart = Cart::all();
        return view('/cart');
    }
}
