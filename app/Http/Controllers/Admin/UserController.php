<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
	public function index()
	{
		$users = User::orderByDesc('id')->paginate(5);
		return view('admin.users.index', ['users' => $users]);
	}

	public function create()
	{
		return view('admin.users.create');
	}

	public function store(Request $request)
	{
		$request->validate([
			'name' => 'required|string|max:255',
			'email' => 'required|email|unique:users,email|max:255',
			'password' => 'required|string|min:6|confirmed',
			'role' => 'required|in:user,admin', // Thêm role nếu cần phân quyền
		]);

		User::create([
			'name' => $request->name,
			'email' => $request->email,
			'password' => Hash::make($request->password),
			'role' => $request->role,
		]);

		return redirect()->route('admin.user.list')->with('success', 'Người dùng đã được thêm!');
	}

	public function edit($id)
	{
		$user = User::findOrFail($id);
		return view('admin.users.edit', ['user' => $user]);
	}

	public function update(Request $request, $id)
	{
		$user = User::findOrFail($id);

		$request->validate([
			'name' => 'required|string|max:255',
			'email' => 'required|email|unique:users,email,' . $user->id . '|max:255',
			'role' => 'required|in:user,admin',
			'password' => 'nullable|string|min:6|confirmed', // Password có thể để trống
		]);

		$data = [
			'name' => $request->name,
			'email' => $request->email,
			'role' => $request->role,
		];

		if ($request->filled('password')) {
			$data['password'] = Hash::make($request->password);
		}

		$user->update($data);

		return redirect()->route('admin.user.list')->with('success', 'Người dùng đã được cập nhật!');
	}

	public function destroy($id)
	{
		$user = User::findOrFail($id);
		$user->delete();
		return redirect()->route('admin.user.list')->with('success', 'Người dùng đã được xóa!');
	}
}
