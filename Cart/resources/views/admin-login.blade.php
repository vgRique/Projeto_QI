@extends('layouts.main')

@section('title', 'Login da administração')

@section('content')

<h1>Login da administração</h1>

<div id="admin-content">
    <h2>Login de Admin</h2>
    <form id="admin-login-form" method="POST" action="{{ route('login') }}">
        <label for="username">Usuário:</label>
        <input type="text" id="username" name="username" required>
        <label for="admin-password">Senha:</label>
        <input type="password" id="password" name="password" required>
        @csrf
        <button type="submit">Entrar</button>
    </form>
</div>


@endsection