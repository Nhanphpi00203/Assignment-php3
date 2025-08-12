<?php

use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Client\CartController;
use App\Http\Controllers\Client\ContactController;
use App\Http\Controllers\Client\HomeController;
use App\Http\Controllers\Client\OrderController;
use App\Http\Controllers\Client\ProductController as ClientProductController;
use App\Http\Controllers\ProfileController;
use App\Http\Middleware\checkAdmin;
use App\Http\Middleware\CheckOrder;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
	return view('welcome');
})->middleware(checkAdmin::class)->name('home');

Route::name('admin.')->prefix('admin')->group(function () {
	// 100 cái route của admin
})->middleware(checkAdmin::class);

Route::get('order/{idOrder}', [OrderController::class, 'viewOrderDetail'])
	->middleware(CheckOrder::class);


Route::get('/dashboard', function () {
	return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');



Route::middleware('auth')->group(function () {
	Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
	Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
	Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';

Route::name('client.')->group(function () {
	Route::get('/', [HomeController::class, 'index'])->name('home');
	Route::name('sanpham.')->group(function () {
		Route::get('products', [ClientProductController::class, 'listProduct'])->name('list');       // sanpham.list
		Route::get('products/{id}', [ClientProductController::class, 'detailProduct'])->name('detail');  // sanpham.detail
	});
	Route::name('cart.')->group(function () {
		Route::get('cart', [CartController::class, 'showCart'])->name('show');
		Route::post('add/{id}', [CartController::class, 'addToCart'])->name('add');
		Route::put('update/{id}', [CartController::class, 'updateCart'])->name('update');
		Route::delete('remove/{id}', [CartController::class, 'removeFromCart'])->name('remove');
		Route::post('clear', [CartController::class, 'clearCart'])->name('clear');
	});
	Route::name('checkout.')->group(function () {
		Route::get('checkout', [CartController::class, 'checkoutForm'])->name('form');
		Route::post('checkout', [CartController::class, 'checkoutSubmit'])->name('submit');
	});

	Route::name('contact.')->group(function () {
		Route::get('lien-he', [ContactController::class, 'index'])->name('index');
		Route::post('lien-he', [ContactController::class, 'store'])->name('store');
	});
});
