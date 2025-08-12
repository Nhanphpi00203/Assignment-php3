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
				"id" => $product->id,
				"title" => $product->title,
				"price" => $product->sale_price > 0 ? $product->sale_price : $product->price,
				"thumbnail" => $product->thumbnail ? asset('storage/' . $product->thumbnail) : 'https://via.placeholder.com/150',
				"quantity" => 1
			];
		}

		session()->put('cart', $cart);

		return redirect()->route('client.cart.show')->with('success', 'Thêm sản phẩm vào giỏ hàng thành công!');
	}

	public function updateCart(Request $request, $id)
	{
		$quantity = (int) $request->input('quantity', 1);
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
		return redirect()->back()->with('success', 'Đã xóa sản phẩm khỏi giỏ hàng');
	}

	public function clearCart()
	{
		session()->forget('cart');
		return redirect()->back()->with('success', 'Đã xóa toàn bộ giỏ hàng');
	}

	public function checkoutForm()
	{
		$cartItems = session()->get('cart', []);
		return view('client.checkout', compact('cartItems'));
	}

	public function checkoutSubmit(Request $request)
	{
		$request->validate([
			'name' => 'required|string|max:255',
			'email' => 'required|email',
			'phone' => 'required|string|max:20',
			'address' => 'required|string|max:500',
		]);

		$cartItems = session()->get('cart', []);
		if (empty($cartItems)) {
			return redirect()->route('client.cart.show')->with('error', 'Giỏ hàng của bạn đang trống.');
		}

		// Xử lý lưu đơn hàng vào DB (nếu có)

		// Sau khi đặt hàng xong, xóa giỏ hàng
		session()->forget('cart');

		return redirect()->route('client.home')->with('success', 'Đặt hàng thành công! Chúng tôi sẽ liên hệ bạn sớm.');
	}
}
