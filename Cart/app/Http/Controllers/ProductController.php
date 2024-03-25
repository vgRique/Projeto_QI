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

    public function edit($productid)
    {
        $product = Product::find($productid);

        // Se o produto não existir, redireciona para uma página de erro ou outra rota
        if (!$product) {
            return redirect()->route('products-list')->with('error', 'Produto não encontrado.');
        }

        // Se o produto existir, retorna a view de edição com o produto
        return view('edit-product', compact('product'));
    }
    
    public function delete(Request $request)
    {
        $id = $request->input('id_product');
        $product = Product::find($id);
    
        if (!$product) {
            return redirect()->route('admin')->with('error', 'Produto não encontrado.');
        }
    
        $product->delete();
    
        return redirect()->route('admin')->with('success', 'Produto removido com sucesso.');
    
    }

    public function update(Request $request)
    {
        // Validação dos dados do formulário
        $request->validate([
            'nome' => 'required|string',
            'preco' => 'required|numeric',
            'categoria' => 'nullable|string',
            'imagem' => 'nullable|image',
            'id' => 'numeric'

        ]);

        // Encontra o produto pelo ID
        $product = Product::find($request->input('id'));

        // Se o produto não for encontrado, redireciona de volta com uma mensagem de erro
        if (!$product) {
            return redirect()->back()->with('error', 'Produto não encontrado.');
        }

        $imagem = null;
        if ($request->hasFile('imagem')) {
            $imagem = $request->file('imagem')->store('/public/img');
        }else {
            return response()->json(['message' => 'O arquivo de imagem não é válido.'], 422);
        }

        // Atualiza os dados do produto
        $product->nome = $request->input('nome');
        $product->preco = $request->input('preco');
        $product->categoria = $request->input('categoria');
        if($imagem != null){
        $product->imagem = $request->input('imagem');
        }
        $product->save();

        // Redireciona para a página de administração com uma mensagem de sucesso
        return redirect()->route('admin')->with('success', 'Produto atualizado com sucesso.');
    }


}

?>