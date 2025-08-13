<?php

use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\CommentController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\OrderController as AdminOrderController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Client\CartController;
use App\Http\Controllers\Client\CheckoutController;
use App\Http\Controllers\Client\ContactController;
use App\Http\Controllers\Client\HomeController;
use App\Http\Controllers\Client\MyOrderController;
use App\Http\Controllers\Client\OrderController;
use App\Http\Controllers\Client\ProductController as ClientProductController;
use App\Http\Controllers\ProfileController;
use App\Http\Middleware\checkAdmin;
use App\Http\Middleware\CheckOrder;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\UserController;


Route::name('admin.')->prefix('admin')->middleware(checkAdmin::class)->group(function () {
	Route::get('/', [DashboardController::class, 'dashboard'])->name('dashboard');

	Route::resource('products', ProductController::class)
		->except(['show'])
		->names([
			'index' => 'product.list',
			'create' => 'product.create',
			'store' => 'product.store',
			'edit' => 'product.edit',
			'update' => 'product.update',
			'destroy' => 'product.destroy',
		]);
	Route::resource('categories', CategoryController::class)
		->except(['show'])
		->names([
			'index' => 'category.list',
			'create' => 'category.create',
			'store' => 'category.store',
			'edit' => 'category.edit',
			'update' => 'category.update',
			'destroy' => 'category.destroy',
		]);
	Route::resource('orders', AdminOrderController::class)
		->except(['show'])
		->names([
			'index' => 'order.list',
			'create' => 'order.create',
			'store' => 'order.store',
			'edit' => 'order.edit',
			'update' => 'order.update',
			'destroy' => 'order.destroy',
		]);

	Route::resource('comments', CommentController::class)
		->except(['show'])
		->names([
			'index' => 'comment.list',
			'create' => 'comment.create',
			'store' => 'comment.store',
			'edit' => 'comment.edit',
			'update' => 'comment.update',
			'destroy' => 'comment.destroy',
		]);


	Route::resource('users', UserController::class)
		->except(['show'])
		->names([
			'index' => 'user.list',
			'create' => 'user.create',
			'store' => 'user.store',
			'edit' => 'user.edit',
			'update' => 'user.update',
			'destroy' => 'user.destroy',
		]);
});

Route::get('order/{idOrder}', [OrderController::class, 'viewOrderDetail'])
	->middleware(CheckOrder::class);


Route::get('/dashboard', function () {
	return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');



Route::middleware('auth')->group(function () {

	Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
	Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
	Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
	Route::get('/my-orders', [MyOrderController::class, 'index'])->name('client.my-orders');
	Route::get('/my-orders/{order}', [MyOrderController::class, 'show'])->name('client.my-order-details');
	Route::get('/my-orders/{order}/cancel', [MyOrderController::class, 'cancel'])->name('client.my-order-cancel');

	Route::get('/checkout', [CheckoutController::class, 'showForm'])->name('checkout.form');
	Route::post('/checkout', [CheckoutController::class, 'submit'])->name('checkout.submit');
	Route::get('/checkout/success', [CheckoutController::class, 'success'])->name('checkout.success');
	Route::prefix('cart')->name('cart.')->group(function () {
		Route::get('/', [CartController::class, 'showCart'])->name('show');
		Route::post('add/{id}', [CartController::class, 'addToCart'])->name('add');
		Route::put('update/{id}', [CartController::class, 'updateCart'])->name('update');
		Route::delete('remove/{id}', [CartController::class, 'removeFromCart'])->name('remove');
		Route::post('clear', [CartController::class, 'clearCart'])->name('clear');
	});
});

require __DIR__ . '/auth.php';

Route::name('client.')->group(function () {


	Route::get('/', [HomeController::class, 'index'])->name('home');
	// Sản phẩm
	Route::prefix('products')->name('sanpham.')->group(function () {
		Route::get('/', [ClientProductController::class, 'listProduct'])->name('list');
		Route::get('/{id}', [ClientProductController::class, 'show'])->name('detail');
		Route::get('/category/{id}', [ClientProductController::class, 'listProduct'])->name('category');
		Route::post('/{id}/comment', [ClientProductController::class, 'storeComment'])->name('comment.store');
	});

	// Giỏ hàng


	// Liên hệ
	Route::prefix('lien-he')->name('contact.')->group(function () {
		Route::get('/', [ContactController::class, 'index'])->name('index');
		Route::post('/', [ContactController::class, 'store'])->name('store');
	});
});
