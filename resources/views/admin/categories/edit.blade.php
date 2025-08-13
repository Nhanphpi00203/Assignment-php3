@extends('admin.layouts.master')

@section('title', 'Sửa danh mục')

@section('content')
<div class="pt-3 pb-2 mb-4 border-bottom">
    <h1 class="h3 fw-bold text-primary">
        ✏️ Sửa danh mục
    </h1>
</div>

<div class="card shadow-sm border-0 rounded-3">
    <div class="card-body">
        <form method="POST" action="{{ route('admin.category.update', $category->id) }}">
            @csrf
            @method('PUT')

            <div class="mb-3">
                <label for="name" class="form-label fw-semibold">Tên</label>
                <input type="text" class="form-control" id="name" name="name"
                       value="{{ old('name', $category->name) }}" required>
            </div>

            <div class="mb-3">
                <label for="slug" class="form-label fw-semibold">Slug</label>
                <input type="text" class="form-control" id="slug" name="slug"
                       value="{{ old('slug', $category->slug) }}">
            </div>

            <div class="mb-3">
                <label for="description" class="form-label fw-semibold">Mô tả</label>
                <textarea class="form-control" id="description" name="description"
                          rows="3">{{ old('description', $category->description) }}</textarea>
            </div>
           <div class="mb-3">
    <label for="status" class="form-label fw-semibold">Trạng thái</label>
    <select class="form-select" id="status" name="status" required>
        <option value="1" {{ old('status', $category->status) == 1 ? 'selected' : '' }}>Hiển thị</option>
        <option value="0" {{ old('status', $category->status) == 0 ? 'selected' : '' }}>Ẩn</option>
    </select>
</div>


            <div class="d-flex justify-content-between">
                <a href="{{ route('admin.category.list') }}" class="btn btn-outline-secondary">
                    ⬅ Quay lại
                </a>
                <button type="submit" class="btn btn-primary">
                    💾 Cập nhật
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
