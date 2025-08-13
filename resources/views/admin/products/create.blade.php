@extends('admin.layouts.master')

@section('title', 'Thêm sản phẩm')

@section('content')
<div class="container py-4">
    <div class="d-flex justify-content-between align-items-center border-bottom pb-2 mb-4">
        <h1 class="h3 mb-0"><i class="bi bi-plus-circle"></i> Thêm sản phẩm</h1>
        <a href="{{ route('admin.product.list') }}" class="btn btn-outline-secondary btn-sm">
            <i class="bi bi-arrow-left"></i> Quay lại
        </a>
    </div>

    <div class="card shadow-sm border-0">
        <div class="card-body">
            <form method="POST" action="{{ route('admin.product.store') }}" enctype="multipart/form-data">
                @csrf

                {{-- Tiêu đề --}}
                <div class="mb-3">
                    <label for="title" class="form-label fw-bold">Tiêu đề <span class="text-danger">*</span></label>
                    <input type="text" class="form-control @error('title') is-invalid @enderror"
                           id="title" name="title" value="{{ old('title') }}" placeholder="Nhập tiêu đề sản phẩm">
                    @error('title')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                {{-- Danh mục --}}
                <div class="mb-3">
                    <label for="category_id" class="form-label fw-bold">Danh mục <span class="text-danger">*</span></label>
                    <select class="form-select @error('category_id') is-invalid @enderror"
                            id="category_id" name="category_id">
                        <option value="">-- Chọn danh mục --</option>
                        @foreach ($categories as $category)
                            <option value="{{ $category->id }}"
                                {{ old('category_id') == $category->id ? 'selected' : '' }}>
                                {{ $category->name }}
                            </option>
                        @endforeach
                    </select>
                    @error('category_id')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                {{-- Thumbnail --}}
                <div class="mb-3">
                    <label for="thumbnail" class="form-label fw-bold">Thumbnail</label>
                    <input type="file" class="form-control @error('thumbnail') is-invalid @enderror"
                           id="thumbnail" name="thumbnail" accept="image/*" onchange="previewImage(event)">
                    <div class="mt-2">
                        <img id="preview" src="#" alt="Preview"
                             style="display:none; max-height:150px; border-radius:6px; border:1px solid #ddd;">
                    </div>
                    @error('thumbnail')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                {{-- Mô tả --}}
                <div class="mb-3">
                    <label for="description" class="form-label fw-bold">Mô tả</label>
                    <textarea class="form-control" id="description" name="description" rows="3"
                              placeholder="Nhập mô tả ngắn">{{ old('description') }}</textarea>
                </div>

                {{-- Nội dung --}}
                <div class="mb-3">
                    <label for="content" class="form-label fw-bold">Nội dung</label>
                    <textarea class="form-control" id="content" name="content" rows="5"
                              placeholder="Nhập nội dung chi tiết">{{ old('content') }}</textarea>
                </div>

                {{-- Giá & Giá giảm --}}
{{-- Giá & Giá giảm --}}
<div class="row g-3">
    <div class="col-md-6">
        <label for="price" class="form-label fw-bold">Giá <span class="text-danger">*</span></label>
        <input type="number"
               class="form-control @error('price') is-invalid @enderror"
               id="price" name="price"
               value="{{ old('price') }}"
               placeholder="Nhập giá"
               oninput="formatVNPrice('price', 'price_preview')">
        <small id="price_preview" class="text-muted d-block mt-1"></small>
        @error('price')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>

    <div class="col-md-6">
        <label for="sale_price" class="form-label fw-bold">Giá giảm</label>
        <input type="number"
               class="form-control"
               id="sale_price"
               name="sale_price"
               value="{{ old('sale_price') }}"
               placeholder="Nhập giá giảm (nếu có)"
               oninput="formatVNPrice('sale_price', 'sale_price_preview')">
        <small id="sale_price_preview" class="text-muted d-block mt-1"></small>
    </div>
</div>



                {{-- Trạng thái --}}
                <div class="mb-3 mt-3">
                    <label for="status" class="form-label fw-bold">Trạng thái</label>
                    <select class="form-select" id="status" name="status">
                        <option value="draft" {{ old('status') == 'draft' ? 'selected' : '' }}>Nháp</option>
                        <option value="published" {{ old('status') == 'published' ? 'selected' : '' }}>Công khai</option>
                        <option value="scheduled" {{ old('status') == 'scheduled' ? 'selected' : '' }}>Hẹn giờ</option>
                    </select>
                </div>

                {{-- Nút submit --}}
                <div class="text-end">
                    <button type="submit" class="btn btn-primary px-4">
                        <i class="bi bi-save"></i> Thêm sản phẩm
                    </button>
                </div>

            </form>
        </div>
    </div>
</div>

{{-- Preview ảnh --}}
<script>
    function previewImage(event) {
        const preview = document.getElementById('preview');
        preview.src = URL.createObjectURL(event.target.files[0]);
        preview.style.display = 'block';
    }
</script>
@endsection
