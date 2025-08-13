<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MyOrderController extends Controller
{
	public function index()
	{
		$orders = Order::where('user_id', Auth::id())->with('orderItems')->orderByDesc('id')->paginate(5);
		return view('client.my-orders.index', ['orders' => $orders]);
	}

	public function show($id)
	{
		$order = Order::where('user_id', Auth::id())->with('orderItems')->findOrFail($id);
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
