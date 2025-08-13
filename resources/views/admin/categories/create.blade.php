@extends('admin.layouts.master')

@section('title', 'Thêm danh mục')

@section('content')
<div class="container py-4">
    <div class="d-flex justify-content-between align-items-center border-bottom pb-2 mb-4">
        <h1 class="h3 fw-bold text-primary">➕ Thêm danh mục</h1>
    </div>

    <div class="card shadow-sm border-0 rounded-3">
        <div class="card-body">
            <form method="POST" action="{{ route('admin.category.store') }}">
                @csrf

                <div class="mb-3">
                    <label for="name" class="form-label fw-semibold">Tên <span class="text-danger">*</span></label>
                    <input type="text"
                           class="form-control shadow-sm border-0"
                           style="background: #f8f9fa"
                           id="name"
                           name="name"
                           value="{{ old('name') }}"
                           required>
                </div>

                <div class="mb-3">
                    <label for="slug" class="form-label fw-semibold">Slug</label>
                    <input type="text"
                           class="form-control shadow-sm border-0"
                           style="background: #f8f9fa"
                           id="slug"
                           name="slug"
                           value="{{ old('slug') }}">
                </div>

                <div class="mb-3">
                    <label for="description" class="form-label fw-semibold">Mô tả</label>
                    <textarea class="form-control shadow-sm border-0"
                              style="background: #f8f9fa; min-height: 100px"
                              id="description"
                              name="description">{{ old('description') }}</textarea>
                </div>

                <button type="submit" class="btn btn-primary px-4 shadow-sm">
                    <i class="bi bi-plus-circle"></i> Thêm
                </button>
            </form>
        </div>
    </div>
</div>

<style>
    .form-control:focus {
        border-color: #4e73df;
        box-shadow: 0 0 0 0.2rem rgba(78, 115, 223, 0.25);
    }
    button.btn-primary {
        background-color: #4e73df;
        border: none;
        transition: 0.2s;
    }
    button.btn-primary:hover {
        background-color: #2e59d9;
    }
</style>
@endsection
