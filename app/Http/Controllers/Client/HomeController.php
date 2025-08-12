<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;
use App\Models\Product;

class HomeController extends Controller
{

	// public function test() {
	//     return view('client.layouts.master');
	// }

	// public function index()
	// {
	//     $data = DB::table('categories')->get();

	//     return view('client.home', [
	//         'categories' => $data
	//     ]);
	// }


	// public function tinTrongLoai($idLoaiSanPham)
	// {
	//     // $data = DB::table('products')
	//     //     ->where('category_id', $idLoaiSanPham)
	//     //     ->get();


	//     return view('client.categories.list-product', [
	//         'products' => Product::where('category_id', $idLoaiSanPham)->get()
	//     ]);
	// }


	// public function chitiet($idsanpham)
	// {
	//     // $data = DB::table('products')
	//     //     ->where('id', $idsanpham)
	//     //     ->first();

	//     return view('client.product.detail', [
	//         'product' => Product::find($idsanpham)
	//     ]);
	// }
	public function index()
	{
		$categories = DB::table('categories')
			->where('status', 1)
			->orderBy('name', 'asc')
			->get();

		$products = DB::table('products')
			->select('id', 'title', 'price', 'sale_price', 'thumbnail')
			->orderBy('created_at', 'desc')
			->limit(8)
			->get();
		// dd($products);
		return view('client.home', compact('categories', 'products'));
	}
}
