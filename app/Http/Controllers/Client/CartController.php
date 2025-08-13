<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;

class CartController extends Controller
{
	public function showCart()
	{
		$cartItems = session()->get('cart', []);
		return view('client.cart', compact('cartItems'));
	}

	public function addToCart(Request $request, $id)
	{
		$product = Product::findOrFail($id);
		$cart = session()->get('cart', []);

		if (isset($cart[$id])) {
			$cart[$id]['quantity']++;
		} else {
			$cart[$id] = [
				"id"        => $product->id,
				"name"      => $product->title, // dùng "name" đồng nhất
				"price"     => $product->sale_price > 0 ? $product->sale_price : $product->price,
				"thumbnail" => $product->thumbnail ? asset('storage/' . $product->thumbnail) : 'https://via.placeholder.com/150',
				"quantity"  => 1
			];
		}

		session()->put('cart', $cart);
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
