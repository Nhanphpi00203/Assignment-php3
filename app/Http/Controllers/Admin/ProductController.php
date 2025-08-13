<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ProductController extends Controller
{
	public function index()
	{
		$products = Product::orderByDesc('id')->paginate(5);
		return view('admin.products.index', ['products' => $products]);
	}

	public function create()
	{
		$categories = Category::all();
		return view('admin.products.create', ['categories' => $categories]);
	}

	public function store(Request $request)
	{
		$request->validate([
			'title' => 'required|string|max:255',
			'category_id' => 'required|exists:categories,id',
			'thumbnail' => 'nullable|image|max:2048',
			'description' => 'nullable|string',
			'content' => 'nullable|string',
			'price' => 'required|numeric|min:0',
			'sale_price' => 'nullable|numeric|min:0',
			'status' => 'required|in:draft,published,scheduled',
		]);

		$image_uploaded_url = $this->uploadImage($request->file('thumbnail'));

		Product::create([
			'title' => $request->title,
			'slug' => Str::slug($request->title),
			'category_id' => $request->category_id,
			'thumbnail' => $image_uploaded_url,
			'description' => $request->description,
			'content' => $request->content,
			'price' => $request->price,
			'sale_price' => $request->sale_price ?? 0,
			'status' => $request->status,
			'created_at' => now(),
			'updated_at' => now(),
		]);

		return redirect()->route('admin.product.list')->with('success', 'Sản phẩm đã được thêm!');
	}

	public function edit(int $id)
	{
		$product = Product::findOrFail($id);
		$categories = Category::all();
		return view('admin.products.edit', ['categories' => $categories, 'product' => $product]);
	}

	public function update(Request $request, int $id)
	{
		$request->validate([
			'title' => 'required|string|max:255',
			'category_id' => 'required|exists:categories,id',
			'thumbnail' => 'nullable|image|max:2048',
			'description' => 'nullable|string',
			'content' => 'nullable|string',
			'price' => 'required|numeric|min:0',
			'sale_price' => 'nullable|numeric|min:0',
			'status' => 'required|in:draft,published,scheduled',
		]);

		$product = Product::findOrFail($id);
		$image_uploaded_url = $product->thumbnail;
		if ($request->hasFile('thumbnail')) {
			if ($image_uploaded_url && file_exists(public_path('uploads/' . $image_uploaded_url))) {
				unlink(public_path('uploads/' . $image_uploaded_url));
			}
			$image_uploaded_url = $this->uploadImage($request->file('thumbnail'));
		}

		$product->update([
			'title' => $request->title,
			'slug' => Str::slug($request->title),
			'category_id' => $request->category_id,
			'thumbnail' => $image_uploaded_url,
			'description' => $request->description,
			'content' => $request->content,
			'price' => $request->price,
			'sale_price' => $request->sale_price ?? 0,
			'status' => $request->status,
			'updated_at' => now(),
		]);

		return redirect()->route('admin.product.list')->with('success', 'Sản phẩm đã được cập nhật!');
	}

	public function destroy(int $id)
	{
		$product = Product::findOrFail($id);
		if ($product->thumbnail && file_exists(public_path('uploads/' . $product->thumbnail))) {
			unlink(public_path('uploads/' . $product->thumbnail));
		}
		$product->delete();
		return redirect()->route('admin.product.list')->with('success', 'Sản phẩm đã được xóa!');
	}

	private function uploadImage($file)
	{
		if ($file) {
			$fileName = time() . '_' . Str::random(10) . '.' . $file->getClientOriginalExtension();
			$file->move(public_path('uploads'), $fileName);
			return $fileName;
		}
		return null;
	}
}
