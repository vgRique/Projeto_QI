<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\AdminLoginController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\UserController;

Route::get('cart', [CartController::class, 'index']) ->name('cart');


Route::get('admin', [AdminController::class,'admin'])->middleware('auth') ->name('admin');

Route::get('login', [AdminLoginController::class, 'login'])->name('login');
Route::post('login', [UserController::class, 'authenticate']);
Route::get('logout', [UserController::class, 'logout'])->name('logout');
Route::post('register', [UserController::class, 'createUser'])->name('register');


Route::get('', [ProductController::class, 'index']);
Route::get('/register', [UserController::class, 'index']);
Route::post('products', [ProductController::class, 'store']);
Route::get('/products/{productid}', [ProductController::class, 'edit'])->name("products-edit");


Route::post('/products/remove/', [ProductController::class, 'delete'])->name("products-remove");
Route::put('/products/update/',  [ProductController::class, 'update'])-> name("products-update");

Route::post('/cart/add/',[CartController::class, 'addCart'])->name('add-to-cart');
