@extends('layouts.main')

@section('title', 'Login da administração')

@section('content')

<h1>Login da administração</h1>

<div id="admin-content">
    <h2>Login de Admin</h2>
    <form id="admin-login-form">
        <label for="admin-username">Usuário:</label>
        <input type="text" id="admin-username" name="admin-username" required>

        <label for="admin-password">Senha:</label>
        <input type="password" id="admin-password" name="admin-password" required>

        <button type="button" onclick="authenticateAdmin()">Entrar</button>
    </form>
</div>

@endsection