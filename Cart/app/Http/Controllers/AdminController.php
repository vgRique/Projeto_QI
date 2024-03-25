<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Product;

class AdminController extends Controller  
{
    public function admin() {
        if (Auth::check() && Auth::user()->is_admin) {
            $products = Product::all();
            return view('admin',  compact('products'));
        }
    
        // Redireciona para a página inicial caso o usuário não seja um administrador
        return redirect('/');
    }
}
?>