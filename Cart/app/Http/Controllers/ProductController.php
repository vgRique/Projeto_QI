<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;

class ProductController extends Controller
{ 
   
    //
    public function index() {
        $products = Product::all();
        return view('welcome', compact('products'));
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
            $imagem = $request->file('imagem')->store('/public/img');
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
    
    public function show($id)
    {
        $product = Product::find($id);
        if (!$product) {
            return response()->json(['message' => 'Produto não encontrado'], 404);
        }

        return response()->json(['product' => $product], 200);
    }
}

?>