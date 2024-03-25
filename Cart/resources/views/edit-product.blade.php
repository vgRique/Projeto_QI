@extends('layouts.main')

@section('title', 'Editar')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Editar Produto</div>

                <div class="card-body">
                    <form action="{{ route('products-update', ['productid' => $product->id]) }}" method="POST">
                        @csrf
                        @method('PUT')

                        <div class="form-group">
                            <label for="nome">Nome:</label>
                            <input type="text" class="form-control" id="nome" name="nome" value="{{ $product->nome }}">
                        </div>
                        <div class="form-group">
                            <label for="preco">Preço:</label>
                            <input type="text" class="form-control" id="preco" name="preco" value="{{ $product->preco }}">
                        </div>
                        <div class="form-group">
                            <label for="categoria">Categoria:</label>
                            <input type="text" class="form-control" id="categoria" name="categoria" value="{{ $product->categoria }}">
                        </div>
                        <div class="form-group">
                            <label for="categoria">Imagem:</label>
                            
                            <input type="file" name="imagem" id="imagem">
                        </div>
                        <div class="form-group">
                            <input type="text" class="form-control" id="id" name="id" value="{{ $product->id }}" hidden>
                            <button type="submit" class="btn btn-primary">Salvar</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>


@endsection