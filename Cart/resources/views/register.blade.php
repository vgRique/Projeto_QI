@extends('layouts.main')

@section('title', 'Registrar usuário')

@section('content')

<h1>Administração</h1>

<form method="POST" action="{{ route('register')}}">
    @csrf
    <label for="username">Nome de Usuário:</label>
    <input type="text" id="username" name="username" required><br><br>

    <label for="password">Senha:</label>
    <input type="password" id="password" name="password" required><br><br>

    <label for="email">E-mail:</label>
    <input type="email" id="email" name="email" required><br><br>

    <label for="is_admin">É Administrador?</label>
    <input type="checkbox" id="is_admin" name="is_admin" value="1"><br><br>

    <button type="submit">Criar Usuário</button>
</form>


<script>
        function saveProduct() {
            var name = document.getElementById('product-name').value;
            var price = document.getElementById('product-price').value;
            var category = document.getElementById('product-category').value;
            var imagem = document.getElementById('imagem').files[0];
            //var csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
            var csrfToken = "{{ csrf_token() }}";


            var formData = new FormData();
            formData.append('nome', name);
            formData.append('preco', price);
            formData.append('categoria', category);
            formData.append('imagem', imagem);
            formData.append('_token', csrfToken);

            var xhr = new XMLHttpRequest();
            xhr.open('POST', '/products', true);
            xhr.onreadystatechange = function () {
                if (xhr.readyState === 4 && xhr.status === 201) {
                    alert('Produto adicionado com sucesso!');
                }
            };
            xhr.send(formData);
        }
</script>


@endsection