<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class CheckoutController extends Controller
{
	// Hiển thị form thanh toán (truyền $cart vào view)
	public function showForm()
	{
		$cart = session()->get('cart', []); // đảm bảo có mảng, không null

		if (empty($cart)) {
			// nếu muốn chuyển về giỏ hàng khi trống
			return redirect()->route('client.cart.show')
				->with('error', 'Giỏ hàng của bạn đang trống!');
		}

		return view('client.checkout', compact('cart'));
	}

	// Xử lý submit
	public function submit(Request $request)
	{
		$cart = session()->get('cart', []);
		if (empty($cart)) {
			return redirect()->route('client.cart.show')->with('error', 'Giỏ hàng trống!');
		}

		$request->validate([
			'name'    => 'required|string|max:255',
			'email'   => 'required|email',
			'phone'   => 'required|string|max:20',
			'address' => 'required|string|max:500',
		]);

		// Tính tổng với giá đã giảm
		$total = 0;
		foreach ($cart as $item) {
			$originalPrice = (float) ($item['price'] ?? 0);
			$salePrice = (float) ($item['sale_price'] ?? 0); // Lấy sale_price từ cart
			$finalPrice = $salePrice > 0 && $salePrice < $originalPrice ? $originalPrice - $salePrice : $originalPrice;
			$quantity = (float) ($item['quantity'] ?? 0);
			$total += $finalPrice * $quantity;
		}

		DB::beginTransaction();
		try {
			$orderId = DB::table('orders')->insertGetId([
				'user_id'      => Auth::id(),
				'customer_name' => $request->name,
				'customer_email' => $request->email,
				'customer_phone' => $request->phone,
				'customer_addr' => $request->address,
				'total_price'  => $total,
				'status'       => 'pending',
				'created_at'   => Carbon::now(),
				'updated_at'   => Carbon::now(),
			]);

			foreach ($cart as $productId => $item) {
				$originalPrice = (float) ($item['price'] ?? 0);
				$salePrice = (float) ($item['sale_price'] ?? 0); // Lấy sale_price từ cart
				$finalPrice = $salePrice > 0 && $salePrice < $originalPrice ? $originalPrice - $salePrice : $originalPrice;

				DB::table('order_items')->insert([
					'order_id'   => $orderId,
					'product_id' => $item['id'] ?? $productId,
					'name'       => $item['name'] ?? ($item['title'] ?? 'N/A'),
					'price'      => $finalPrice, // Lưu giá đã giảm
					'quantity'   => $item['quantity'] ?? 0,
					'created_at' => Carbon::now(),
					'updated_at' => Carbon::now(),
				]);
			}

			DB::commit();

			// Xóa giỏ hàng
			session()->forget('cart');

			return redirect()->route('checkout.success')->with('success', 'Đặt hàng thành công!');
		} catch (\Throwable $e) {
			DB::rollBack();
			return back()->with('error', 'Có lỗi: ' . $e->getMessage());
		}
	}

	public function success()
	{
		return view('client.checkout_success');
	}
}
