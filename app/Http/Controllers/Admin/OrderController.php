<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\User;
use Illuminate\Http\Request;

class OrderController extends Controller
{
	public function index()
	{
		$orders = Order::with(['user', 'orderItems'])->orderByDesc('id')->paginate(5);
		foreach ($orders as $order) {
			if ($order->total_price === null || $order->total_price == 0) {
				$total = $order->orderItems->sum(function ($item) {
					return $item->price * $item->quantity;
				}) ?? 0;
				$order->update(['total_price' => $total]);
			}
		}
		return view('admin.orders.index', ['orders' => $orders]);
	}

	public function create()
	{
		$users = User::all();
		return view('admin.orders.create', ['users' => $users]);
	}

	public function store(Request $request)
	{
		$request->validate([
			'user_id' => 'required|exists:users,id',
			'customer_name' => 'required|string|max:255',
			'customer_email' => 'required|email|max:255',
			'customer_phone' => 'required|string|max:20',
			'customer_addr' => 'required|string|max:255',
			'total_price' => 'required|numeric|min:0',
			'status' => 'required|in:pending,processing,completed,cancelled',
		]);

		$order = Order::create([
			'user_id' => $request->user_id,
			'customer_name' => $request->customer_name,
			'customer_email' => $request->customer_email,
			'customer_phone' => $request->customer_phone,
			'customer_addr' => $request->customer_addr,
			'total_price' => $request->total_price,
			'status' => $request->status,
			'created_at' => now(),
			'updated_at' => now(),
		]);

		return redirect()->route('admin.order.list')->with('success', 'Đơn hàng đã được thêm!');
	}

	public function edit($id)
	{
		$order = Order::with('orderItems')->findOrFail($id);
		$users = User::all();
		return view('admin.orders.edit', ['order' => $order, 'users' => $users]);
	}

	public function update(Request $request, $id)
	{
		$request->validate([
			'user_id' => 'required|exists:users,id',
			'customer_name' => 'required|string|max:255',
			'customer_email' => 'required|email|max:255',
			'customer_phone' => 'required|string|max:20',
			'customer_addr' => 'required|string|max:255',
			'total_price' => 'required|numeric|min:0',
			'status' => 'required|in:pending,processing,completed,cancelled',
		]);

		$order = Order::findOrFail($id);
		$order->update([
			'user_id' => $request->user_id,
			'customer_name' => $request->customer_name,
			'customer_email' => $request->customer_email,
			'customer_phone' => $request->customer_phone,
			'customer_addr' => $request->customer_addr,
			'total_price' => $request->total_price,
			'status' => $request->status,
			'updated_at' => now(),
		]);

		return redirect()->route('admin.order.list')->with('success', 'Đơn hàng đã được cập nhật!');
	}

	public function destroy($id)
	{
		$order = Order::findOrFail($id);
		$order->delete();
		return redirect()->route('admin.order.list')->with('success', 'Đơn hàng đã được xóa!');
	}
}
