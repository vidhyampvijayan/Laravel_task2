<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginRegisterController;
use App\Http\Controllers\BookController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CheckoutController;
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

Route::get('/dashboard', function () {
    return view('welcome');
});

Route::controller(LoginRegisterController::class)->group(function() {
    Route::get('/register', 'register')->name('register');
    Route::post('/store', 'store')->name('store');
    Route::get('/', 'login')->name('login');
    Route::post('/authenticate', 'authenticate')->name('authenticate');
    Route::get('/dashboard', 'dashboard')->name('dashboard');
    Route::get('/logout', 'logout')->name('logout');
});
Route::get('/admin/books/create', [BookController::class, 'create'])->name('admin.books.create');
Route::post('/admin/books/store', [BookController::class, 'store'])->name('admin.books.store');

Route::get('/BookDetails', [BookController::class, 'index'])->name('BookDetails');
Route::post('/cart/add', [BookController::class, 'addToCart'])->name('cart.add');
Route::get('/cart', [CartController::class, 'view'])->name('cart.view');
 Route::get('/checkout', [CheckoutController::class, 'show'])->name('checkout');
Route::post('/checkout/process', [CheckoutController::class, 'checkout_process'])->name('checkout.process');

Route::get('/checkout/success', [CheckoutController::class, 'success'])->name('checkout.success');
