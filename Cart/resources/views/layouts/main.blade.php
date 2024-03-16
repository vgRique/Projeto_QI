<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>@yield('title')</title>

    <a href="/">Produtos</a>
    <a href="/cart">Carrinho</a>
    <a href="/admin-login">Login da adm</a>
    <a href="/admin">Administração</a>
  
    <link rel="stylesheet" href="/css/styles.css">
    <script src="/js/scripts.js"></script>
    </head>
    
    <body>

    @yield('content')

    </body>
</html>
