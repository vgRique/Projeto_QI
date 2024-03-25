<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CarrinhoController;
use App\Http\Controllers\AdminLoginController;
use App\Http\Controllers\AdminController;

Route::get('/', [ProductController::class, 'index']);
Route::get('/cart', [CarrinhoController::class, 'carrinho']);
Route::get('/admin-login', [AdminLoginController::class, 'login']);
Route::get('/admin', [AdminController::class, 'admin']);

Route::post('/products', [ProductController::class, 'store']);
