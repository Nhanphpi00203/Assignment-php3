<!-- resources/views/admin/products/edit.blade.php -->
@extends('admin.layouts.master')

@section('title', 'Sửa sản phẩm')

@section('content')
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2">✏ Sửa sản phẩm</h1>
</div>

<form method="POST" action="{{ route('admin.product.update', $product->id) }}" enctype="multipart/form-data" class="bg-white p-4 rounded shadow-sm">
    @csrf
    @method('PUT')

    {{-- Tiêu đề --}}
    <div class="mb-3">
        <label for="title" class="form-label fw-semibold">Tiêu đề</label>
        <input type="text" class="form-control shadow-sm" id="title" name="title"
               value="{{ old('title', $product->title) }}" required>
    </div>

    {{-- Danh mục --}}
    <div class="mb-3">
        <label for="category_id" class="form-label fw-semibold">Danh mục</label>
        <select class="form-select shadow-sm" id="category_id" name="category_id" required>
            @foreach ($categories as $category)
                <option value="{{ $category->id }}"
                    {{ old('category_id', $product->category_id) == $category->id ? 'selected' : '' }}>
                    {{ $category->name }}
                </option>
            @endforeach
        </select>
    </div>

    {{-- Thumbnail --}}
    <div class="mb-3">
        <label for="thumbnail" class="form-label fw-semibold">Thumbnail</label>
        @if ($product->thumbnail)
            <div class="mb-2">
                <img src="{{ asset('uploads/' . $product->thumbnail) }}"
                     alt="Thumbnail"
                     style="max-width: 200px; border-radius: 8px; border: 1px solid #ddd;"
                     class="img-thumbnail shadow-sm">
            </div>
        @endif
        <input type="file" class="form-control shadow-sm" id="thumbnail" name="thumbnail">
    </div>

    {{-- Giá + Giá giảm --}}
<div class="row mb-3">
    <div class="col-md-6">
        <label for="price" class="form-label fw-semibold">Giá (₫)</label>
        <input type="number" class="form-control shadow-sm" id="price" name="price"
               value="{{ old('price', $product->price) }}" required
               oninput="formatVNPrice('price', 'price_preview')">
        <small id="price_preview" class="text-muted d-block mt-1">
            {{ number_format(old('price', $product->price), 0, ',', '.') }} ₫
        </small>
    </div>

    <div class="col-md-6">
        <label for="sale_price" class="form-label fw-semibold">Giá giảm (₫)</label>
        <input type="number" class="form-control shadow-sm" id="sale_price" name="sale_price"
               value="{{ old('sale_price', $product->sale_price) }}"
               oninput="formatVNPrice('sale_price', 'sale_price_preview')">
        <small id="sale_price_preview" class="text-muted d-block mt-1">
            @if(old('sale_price', $product->sale_price))
                {{ number_format(old('sale_price', $product->sale_price), 0, ',', '.') }} ₫
            @endif
        </small>
    </div>
</div>

@push('scripts')
<script>
    function formatVNPrice(inputId, previewId) {
        const input = document.getElementById(inputId);
        const preview = document.getElementById(previewId);
        let value = input.value;

        if (value && !isNaN(value)) {
            preview.innerText = new Intl.NumberFormat('vi-VN').format(value) + ' ₫';
        } else {
            preview.innerText = '';
        }
    }
</script>
@endpush


    {{-- Mô tả --}}
    <div class="mb-3">
        <label for="description" class="form-label fw-semibold">Mô tả</label>
        <textarea class="form-control shadow-sm" id="description" name="description" rows="3">{{ old('description', $product->description) }}</textarea>
    </div>

    {{-- Nội dung --}}
    <div class="mb-3">
        <label for="content" class="form-label fw-semibold">Nội dung</label>
        <textarea class="form-control shadow-sm" id="content" name="content" rows="5">{{ old('content', $product->content) }}</textarea>
    </div>

    {{-- Trạng thái --}}
    <div class="mb-3">
        <label for="status" class="form-label fw-semibold">Trạng thái</label>
        <select class="form-select shadow-sm" id="status" name="status" required>
            <option value="draft" {{ old('status', $product->status) == 'draft' ? 'selected' : '' }}>Draft</option>
            <option value="published" {{ old('status', $product->status) == 'published' ? 'selected' : '' }}>Published</option>
            <option value="scheduled" {{ old('status', $product->status) == 'scheduled' ? 'selected' : '' }}>Scheduled</option>
        </select>
    </div>

    <button type="submit" class="btn btn-primary shadow-sm">💾 Cập nhật</button>


</form>
@endsection
