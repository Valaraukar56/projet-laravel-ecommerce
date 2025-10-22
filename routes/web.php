<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;



Route::get('/', [ProductController::class, 'index'])->name('home');
Route::get('/produits', [ProductController::class, 'index'])->name('products.index');
Route::get('/produits/{product}', [ProductController::class, 'show'])->name('products.show');
Route::view('/panier', 'cart.index')->name('cart.index');
Route::view('/connexion', 'auth.login')->name('login');
