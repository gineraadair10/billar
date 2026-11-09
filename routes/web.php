<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ShopController;
use Illuminate\Support\Facades\Route;

// Tienda (pública)
Route::get('/', [ShopController::class, 'home'])->name('home');
Route::get('/catalogo', [ShopController::class, 'catalog'])->name('catalog');
Route::get('/catalogo/{product}', [ShopController::class, 'show'])->name('product');
Route::get('/carrito', [ShopController::class, 'cart'])->name('cart');
Route::post('/carrito/{product}', [ShopController::class, 'cartAdd'])->name('cart.add');
Route::patch('/carrito/linea/{key}', [ShopController::class, 'cartUpdate'])->name('cart.update');
Route::delete('/carrito/linea/{key}', [ShopController::class, 'cartRemove'])->name('cart.remove');
Route::get('/pedido', [ShopController::class, 'checkout'])->name('checkout');
Route::post('/pedido', [ShopController::class, 'orderStore'])->name('order.store');
Route::get('/pedido/{order}', [ShopController::class, 'orderDone'])->name('order.done');
Route::get('/nosotros', [ShopController::class, 'about'])->name('about');
Route::get('/contacto', [ShopController::class, 'contact'])->name('contact');
Route::post('/contacto', [ShopController::class, 'contactStore'])->name('contact.store');

// Panel (con sesión)
Route::get('/dashboard', [DashboardController::class, 'index'])
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
