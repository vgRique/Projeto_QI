<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title')</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">

    <link rel="stylesheet" href="/css/styles.css">


    
</head>
<body>

<nav id=topbar>
    <a href="/">Produtos</a>
    <a href="/cart">Carrinho</a>
    <a href="/login">Login da adm</a>
    <a href="/admin">Administração</a>

    <div class="user-info">
        @if (Auth::check())
            <span>Username: {{ Auth::user()->username }}</span>
            <a href="/logout">Logout</a>
        @else
            <a href="/register">Registar</a>
        @endif
    </div>
</nav>

<br><br>

@yield('content')

</body>
</html>
