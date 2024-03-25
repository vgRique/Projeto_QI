<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>@yield('title')</title>


    <div>
        <a href="/">Produtos</a>
        <a href="/cart">Carrinho</a>
        <a href="/login">Login da adm</a>
        <a href="/admin">Administração</a>

        @if (Auth::check())
        <p>Username: {{ Auth::user()->username }}</p>
        <a href="/logout">Logout</a>
        @else
        <a href="/register">Registar</a>
        @endif
    </div>

    <br></br>
    

    <link rel="stylesheet" href="/css/styles.css">
    <script src="/js/scripts.js"></script>
    </head>
    
    <body>
    
    @yield('content')
 
    </body>
</html>
