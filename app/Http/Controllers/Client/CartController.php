<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class CartController extends Controller
{
	public function showCart()
	{
		$cartItems = session()->get('cart', []);
		Log::info('Danh sách giỏ hàng từ session: ', ['cartItems' => $cartItems]);
		return view('client.cart', compact('cartItems'));
	}

	public function addToCart(Request $request, $id)
	{
		$product = Product::findOrFail($id);
		$cart = session()->get('cart', []);

		$originalPrice = (float) $product->price;
		$salePrice = (float) $product->sale_price;
		$finalPrice = $salePrice > 0 && $salePrice < $originalPrice ? $originalPrice - $salePrice : $originalPrice;

		Log::info('Thêm sản phẩm', [
			'product_id' => $id,
			'title' => $product->title,
			'price_raw' => $originalPrice,
			'sale_price_raw' => $salePrice,
			'final_price' => $finalPrice,
		]);

		if ($finalPrice <= 0) {
			Log::warning('Giá không hợp lệ', ['product_id' => $id, 'final_price' => $finalPrice]);
			$finalPrice = 40000; // Default price if invalid
		}

		if (isset($cart[$id])) {
			$cart[$id]['quantity']++;
		} else {
			$cart[$id] = [
				'id' => $product->id,
				'name' => $product->title,
				'price' => $originalPrice, // Store original price
				'sale_price' => $salePrice, // Store sale price
				'thumbnail' => $product->thumbnail ? asset('storage/' . $product->thumbnail) : 'https://via.placeholder.com/150',
				'quantity' => 1
			];
		}

		session()->put('cart', $cart);
		Log::info('Giỏ hàng sau khi thêm: ', ['cart' => $cart]);
		return redirect()->route('cart.show')->with('success', 'Thêm sản phẩm thành công!');
	}

	public function updateCart(Request $request, $id)
	{
		$quantity = max(1, (int) $request->input('quantity', 1));
		$cart = session()->get('cart', []);

		if (isset($cart[$id])) {
			$cart[$id]['quantity'] = $quantity;
			session()->put('cart', $cart);
		}
		return redirect()->back()->with('success', 'Cập nhật giỏ hàng thành công');
	}

	public function removeFromCart($id)
	{
		$cart = session()->get('cart', []);
		if (isset($cart[$id])) {
			unset($cart[$id]);
			session()->put('cart', $cart);
		}
		return redirect()->back()->with('success', 'Đã xóa sản phẩm');
	}

	public function clearCart()
	{
		session()->forget('cart');
		return redirect()->back()->with('success', 'Đã xóa toàn bộ giỏ hàng');
	}
}
