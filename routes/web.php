<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\PurchaseController;
use App\Http\Controllers\UserCartController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return redirect()->route('products');
});

// Login 
Route::get('/login', [AuthController::class, 'login_page'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::get('/logout', [AuthController::class, 'logout'])->name('logout');

Route::middleware(['auth'])->group(function () {
    // Products
    Route::prefix('/products')->group(function () {
        Route::get('/', [ProductController::class, 'index'])->name('products');
        Route::post('/{product}/cart', [ProductController::class, 'add_to_cart'])->name('products.add_to_cart');
    });

    // Checkout
    Route::prefix('/summary')->group(function () {
        Route::get('/', [UserCartController::class, 'index'])->name('summary');
        Route::put('/{item}', [UserCartController::class, 'update_quantity'])->name('summary.update_quantity');
        Route::delete('/{item}', [UserCartController::class, 'remove_from_cart'])->name('summary.remove_from_cart');
        Route::post('/purchase', [UserCartController::class, 'purchase'])->name('summary.purchase');
    });

    // History (Purchases)
    Route::prefix('/purchases')->group(function () {
        Route::get('/', [PurchaseController::class, 'index'])->name('purchases');
    });
});