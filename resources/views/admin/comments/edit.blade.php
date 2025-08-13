@extends('admin.layouts.master')

@section('title', 'Edit Comment')

@section('content')
<div class="container my-4">
    <div class="card shadow-sm animate__animated animate__fadeIn" data-aos="fade-up">
        <div class="card-header bg-white d-flex align-items-center gap-2">
            <i class="bi bi-pencil-square fs-4 text-primary"></i>
            <h2 class="mb-0">Edit Comment</h2>
        </div>
        <div class="card-body">
            <form action="{{ route('admin.comment.update', $comment->id) }}" method="POST" class="row g-3">
                @csrf
                @method('PUT')

                <div class="col-12">
                    <label for="content" class="form-label">Content</label>
                    <textarea name="content" id="content" class="form-control hvr-shadow" rows="4" required>{{ $comment->content }}</textarea>
                </div>

                <div class="col-md-6">
                    <label for="status" class="form-label">Status</label>
                    <select name="status" id="status" class="form-select hvr-bounce-to-right" required>
                        <option value="0" {{ $comment->status == 0 ? 'selected' : '' }}>Ẩn</option>
                        <option value="1" {{ $comment->status == 1 ? 'selected' : '' }}>Hiển thị</option>
                    </select>
                </div>

                <div class="col-12">
                    <button type="submit" class="btn btn-primary w-100 hvr-float shadow-sm">
                        <i class="bi bi-save me-2"></i> Update
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
