<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;

class ProductController extends Controller
{
    //
    public function index() {
        return view('welcome');
    }
    
    public function store(Request $request)
{
    $request->validate([
        'nome' => 'required|string',
        'preco' => 'required|numeric',
        'categoria' => 'nullable|string',
        'imagem' => 'nullable|image'
    ]);

    $imagem = null;
    if ($request->hasFile('imagem')) {
        $imagem = $request->file('imagem')->store('public/img');
    }else {
        return response()->json(['message' => 'O arquivo de imagem não é válido.'], 422);
    }

    $product = new Product([
        'nome' => $request->input('nome'),
        'preco' => $request->input('preco'),
        'categoria' => $request->input('categoria'),
        'imagem' => $imagem
    ]);

    $product->save();

    return response()->json(['message' => 'Produto adicionado com sucesso'], 201);
}
}

