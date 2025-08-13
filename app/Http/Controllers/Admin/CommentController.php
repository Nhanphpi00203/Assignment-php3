<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Comment;
use Illuminate\Http\Request;

class CommentController extends Controller
{
	public function index()
	{
		$comments = Comment::paginate(10); // Phân trang, hiển thị 10 comment mỗi trang
		return view('admin.comments.index', compact('comments'));
	}

	public function edit($id)
	{
		$comment = Comment::findOrFail($id);
		return view('admin.comments.edit', compact('comment'));
	}

	public function update(Request $request, $id)
	{
		$comment = Comment::findOrFail($id);

		// Validation dữ liệu đầu vào
		$request->validate([
			'content' => 'required|string|max:1000',
			'status' => 'required|boolean',
		]);

		$comment->update([
			'content' => $request->content,
			'status' => $request->status,
		]);

		return redirect()->route('admin.comment.list')
			->with('success', 'Comment updated successfully');
	}

	public function destroy($id)
	{
		$comment = Comment::findOrFail($id);
		$comment->delete();

		return redirect()->route('admin.comment.list')
			->with('success', 'Comment deleted successfully');
	}
}
