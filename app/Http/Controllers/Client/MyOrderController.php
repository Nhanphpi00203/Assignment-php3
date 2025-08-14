<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class MyOrderController extends Controller
{
	public function index()
	{
		$orders = Order::where('user_id', Auth::id())
			->with(['orderItems' => function ($query) {
				$query->select('id', 'order_id', 'price', 'quantity', 'product_id');
			}])
			->orderByDesc('id')
			->paginate(5);

		// Compute original total and discount for each order
		foreach ($orders as $order) {
			$originalTotal = 0;
			$discountTotal = 0;

			foreach ($order->orderItems as $item) {
				$product = Product::find($item->product_id);
				$originalPrice = (float) ($product ? $product->price : $item->price); // Original price from product
				$finalPrice = (float) $item->price; // Final price from order_items
				$quantity = (float) $item->quantity;
				$originalTotal += $originalPrice * $quantity;

				// Log for debugging
				Log::info('Order Item Pricing', [
					'order_id' => $order->id,
					'product_id' => $item->product_id,
					'original_price' => $originalPrice,
					'final_price' => $finalPrice,
					'quantity' => $quantity,
				]);

				$discount = $originalPrice > $finalPrice ? ($originalPrice - $finalPrice) * $quantity : 0;
				$discountTotal += $discount;
			}

			$order->original_total_price = $originalTotal;
			$order->discount_amount = $discountTotal;
			Log::info('Order Totals', [
				'order_id' => $order->id,
				'original_total' => $originalTotal,
				'discount_total' => $discountTotal,
				'final_total' => $originalTotal - $discountTotal,
			]);
		}

		return view('client.my-orders.index', ['orders' => $orders]);
	}

	public function show($id)
	{
		$order = Order::where('user_id', Auth::id())
			->with(['orderItems' => function ($query) {
				$query->select('id', 'order_id', 'price', 'quantity', 'product_id');
			}])
			->findOrFail($id);

		// Compute original total and discount for the order
		$originalTotal = 0;
		$discountTotal = 0;

		foreach ($order->orderItems as $item) {
			$product = Product::find($item->product_id);
			$originalPrice = (float) ($product ? $product->price : $item->price); // Original price from product
			$finalPrice = (float) $item->price; // Final price from order_items
			$quantity = (float) $item->quantity;
			$originalTotal += $originalPrice * $quantity;

			// Log for debugging
			Log::info('Order Item Pricing', [
				'order_id' => $order->id,
				'product_id' => $item->product_id,
				'original_price' => $originalPrice,
				'final_price' => $finalPrice,
				'quantity' => $quantity,
			]);

			$discount = $originalPrice > $finalPrice ? ($originalPrice - $finalPrice) * $quantity : 0;
			$discountTotal += $discount;
		}

		$order->original_total_price = $originalTotal;
		$order->discount_amount = $discountTotal;
		Log::info('Order Totals', [
			'order_id' => $order->id,
			'original_total' => $originalTotal,
			'discount_total' => $discountTotal,
			'final_total' => $originalTotal - $discountTotal,
		]);

		return view('client.my-orders.show', ['order' => $order]);
	}

	public function cancel($id)
	{
		$order = Order::where('user_id', Auth::id())->findOrFail($id);

		if ($order->status !== 'pending') {
			return redirect()->route('client.my-orders')->with('error', 'Chỉ có thể hủy đơn hàng khi trạng thái là "Chờ xử lý".');
		}

		$order->update(['status' => 'cancelled']);
		return redirect()->route('client.my-orders')->with('success', 'Đơn hàng đã được hủy thành công!');
	}
}
