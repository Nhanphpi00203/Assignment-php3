<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class CategoryController extends Controller
{
	public function index()
	{
		$categories = Category::orderByDesc('id')->paginate(5);
		return view('admin.categories.index', ['categories' => $categories]);
	}

	public function create()
	{
		return view('admin.categories.create');
	}

	public function store(Request $request)
	{
		$request->validate([
			'name' => 'required|string|max:255',
			'slug' => 'nullable|string|max:255',
			'description' => 'nullable|string',
		]);

		Category::create([
			'name' => $request->name,
			'slug' => $request->slug ?? Str::slug($request->name),
			'description' => $request->description,
			'status' => 1,
			'created_at' => now(),
			'updated_at' => now(),
		]);

		return redirect()->route('admin.category.list')->with('success', 'Danh mục đã được thêm!');
	}

	public function edit($id)
	{
		$category = Category::findOrFail($id);
		return view('admin.categories.edit', ['category' => $category]);
	}

	public function update(Request $request, $id)
	{
		$request->validate([
			'name' => 'required|string|max:255',
			'slug' => 'nullable|string|max:255',
			'description' => 'nullable|string',
			'status' => 'required|in:0,1',
		]);

		$category = Category::findOrFail($id);

		$category->update([
			'name' => $request->name,
			'slug' => $request->slug ?? Str::slug($request->name),
			'description' => $request->description,
			'status' => $request->status, // không cần cast nữa, để Laravel tự hiểu
		]);

		return redirect()->route('admin.category.list')->with('success', 'Danh mục đã được cập nhật!');
	}


	public function destroy($id)
	{
		$category = Category::findOrFail($id);
		$category->delete();
		return redirect()->route('admin.category.list')->with('success', 'Danh mục đã được xóa!');
	}
}
