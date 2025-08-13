<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Product;
use App\Models\Category;
use App\Models\Comment;

class DashboardController extends Controller
{
	public function dashboard()
	{
		// Tổng số liệu
		$totalUsers = User::count();
		$totalProducts = Product::count();
		$totalCategories = Category::count();
		$totalComments = Comment::count();

		// Dữ liệu sản phẩm theo danh mục
		$categories = Category::withCount('products')->get();
		$categoryLabels = $categories->pluck('name');
		$categoryData = $categories->pluck('products_count');

		// Ví dụ tỉ lệ user theo role
		$userStats = [
			'admin' => User::where('role', 'admin')->count(),
			'user'  => User::where('role', 'user')->count(),
		];

		return view('admin.dashboard', compact(
			'totalUsers',
			'totalProducts',
			'totalCategories',
			'totalComments',
			'categoryLabels',
			'categoryData',
			'userStats'
		));
	}
}
