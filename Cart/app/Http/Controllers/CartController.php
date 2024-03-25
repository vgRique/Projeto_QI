<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

use Illuminate\Http\Request;
use App\Models\Cart;
use App\Models\Product;


class CartController extends Controller
{
    //

    public function index() {

        $cartItems = null;

        if (Auth::check()) {
            $user = Auth::user();
            $cartItems = $user->cartItems;
            $products = [];

            if ($cartItems) {
                foreach ($cartItems as $cartItem) {
                    $products[] = $cartItem->product;
                }
            }

            $cartItems = $products;
        }

        return view('cart', compact('cartItems'));
    }



    public function addCart(Request $request)
    {
        // Verifica se o usuário está autenticado
        $user = Auth::user();
        if (!$user) {
            return redirect('/login');
            // Redireciona para a página de login
            return redirect()->route('login')->with('error', 'Você precisa estar logado para adicionar itens ao carrinho.');
        }

        // Verifica se o produto existe
        $product = Product::find($request->input('id'));
        if (!$product) {
            return redirect()->route('cart')->with('error', 'Produto não encontrado.');
        }
        
        // Adiciona o produto ao carrinho
        $cart = new Cart();
        $cart->user_id = $user->id;
        $cart->product_id = $request->input('id');
        $cart->save();

        return redirect()->route('cart')->with('success', 'Produto adicionado ao carrinho.');
    }

    public function removeFromCart($id)
    {
        // Encontra e remove o item do carrinho
        $cartItem = Cart::findOrFail($id);
        $cartItem->delete();

        return redirect()->route('cart')->with('success', 'Item removido do carrinho.');
    }

    public function cartCount($userId)
    {
        // Conta o número de itens no carrinho para o ID de usuário específico
        $cartCount = Cart::where('user_id', $userId)->count();

        return response()->json(['cart_count' => $cartCount]);
    }

    public function getCartProducts()
    {
        // Obtém todos os itens no carrinho do usuário autenticado
        $user = Auth::user();
        $cartItems = $user->cartItems;

        // Cria uma lista dos produtos correspondentes
        $products = [];
        foreach ($cartItems as $cartItem) {
            $products[] = $cartItem->product;
        }

        return response()->json(['products' => $products]);
    }
    public function clearCart()
    {
        // Verifica se o usuário está autenticado
        $user = Auth::user();
        if (!$user) {
            return redirect('/login');
            // Redireciona para a página de login
            return redirect()->route('login')->with('error', 'Você precisa estar logado para limpar o carrinho.');
        }

        // Remove todos os itens do carrinho do usuário
        Cart::where('user_id', $user->id)->delete();

        return redirect()->route('cart')->with('success', 'Compra realizada com sucesso.');
    }
}

?>