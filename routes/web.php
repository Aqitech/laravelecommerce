<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\FrontendController;
use App\Http\Controllers\ShoppingController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ProductController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', [FrontendController::class, 'index'])->name('index');
Route::get('/product/{id}', [FrontendController::class, 'single'])->name('product.single');

Route::get('/cart', [ShoppingController::class, 'cart'])->name('cart');
Route::post('/cart/add', [ShoppingController::class, 'add_to_cart'])->name('cart.add');
Route::get('/cart/delete/{id}', [ShoppingController::class, 'delete'])->name('cart.delete');
Route::get('/cart/decrement/{id}/{qty}', [ShoppingController::class, 'decrement'])->name('cart.decrement');
Route::get('/cart/increment/{id}/{qty}', [ShoppingController::class, 'increment'])->name('cart.increment');

Route::get('/checkout', [CheckoutController::class, 'index'])->name('checkout');
Route::post('/checkout', [CheckoutController::class, 'pay'])->name('checkout');

Route::middleware('auth')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::resource('products', ProductController::class);
    Route::get('/status/{id}', [ProductController::class, 'status'])->name('product.status');
});

require __DIR__.'/auth.php';
