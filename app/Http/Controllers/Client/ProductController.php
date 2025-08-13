<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Comment;
use Illuminate\Support\Facades\Auth;

class ProductController extends Controller
{
	// Hiển thị danh sách sản phẩm với phân trang và bộ lọc
	public function listProduct(Request $request, $id = null)
	{
		$query = Product::query();

		// Lọc theo danh mục (từ URL hoặc form)
		if ($id) {
			$query->where('category_id', $id);
		} elseif ($request->filled('category_id')) {
			$query->where('category_id', $request->category_id);
		}

		// Lọc theo giá
		if ($request->filled('min_price')) {
			$query->where('price', '>=', $request->min_price);
		}
		if ($request->filled('max_price')) {
			$query->where('price', '<=', $request->max_price);
		}

		// Tìm kiếm
		if ($request->filled('search')) {
			$query->where('title', 'like', '%' . $request->search . '%');
		}

		$products = $query->latest()->paginate(12);
		$categories = DB::table('categories')
			->where('status', 1)
			->orderBy('name', 'asc')
			->get();

		return view('client.product.index', [
			'products' => $products,
			'categories' => $categories,
			'currentCategory' => $id
		]);
	}


	// Hiển thị chi tiết sản phẩm và sản phẩm liên quan
	public function show($id)
	{
		$product = Product::with('category')->findOrFail($id);
		$relatedProducts = Product::where('category_id', $product->category_id)
			->where('id', '!=', $id)
			->take(4) // Lấy 4 sản phẩm liên quan
			->get();

		return view('client.product.show', compact('product', 'relatedProducts'));
	}

	public function storeComment(Request $request, $id)
	{
		$request->validate([
			'content' => 'required|string|max:1000',
		]);

		$product = Product::findOrFail($id);

		if (Auth::check()) {
			$comment = new Comment();
			$comment->product_id = $product->id;
			$comment->user_id = Auth::id();
			$comment->name = Auth::user()->name;
			$comment->content = $request->content;
			$comment->status = 0; // pending
			$comment->save();

			return redirect()->back()->with('success', 'Bình luận đã được gửi và đang chờ duyệt.');
		}

		return redirect()->back()->with('error', 'Vui lòng đăng nhập để bình luận.');
	}
}
