<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
	// Hiển thị danh sách sản phẩm với phân trang
	public function listProduct()
	{
		$products = Product::orderBy('created_at', 'desc')->paginate(12); // lấy mới nhất, 12 sản phẩm / trang
		return view('client.product.index', compact('products'));
	}

	// Hiển thị chi tiết sản phẩm theo id (hoặc slug nếu bạn muốn)
	public function detailProduct($id)
	{
		$product = Product::findOrFail($id); // nếu không tìm thấy sẽ 404
		return view('client.product.detail', compact('product'));
	}
}
