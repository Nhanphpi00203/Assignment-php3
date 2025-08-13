<!-- resources/views/admin/products/index.blade.php -->
@extends('admin.layouts.master')

@section('title', 'Danh sách sản phẩm')

@section('content')
<div class="pt-3 pb-2 mb-4 border-bottom">
    <div class="d-flex justify-content-between align-items-center">
        <h1 class="h3 mb-0 fw-bold text-primary">
            📦 Danh sách đơn hàng
            <span class="badge bg-secondary">{{ $products->total() }}</span>
        </h1>
        <a href="{{ route('admin.product.create') }}" class="btn btn-success shadow-sm">
            <i class="bi bi-plus-circle me-1"></i> Thêm đơn hàng
        </a>
    </div>
</div>

<div class="table-responsive shadow-sm rounded bg-white p-3">
    <table class="table table-hover align-middle">
        <thead class="table-dark">
            <tr>
                <th scope="col">#ID</th>
                <th scope="col">Ảnh</th>
                <th scope="col">Tiêu đề</th>
                <th scope="col">Giá</th>
                <th scope="col">Giá giảm</th>
                <th scope="col">Trạng thái</th>
                <th scope="col" class="text-center">Hành động</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($products as $product)
                <tr>
                    <td><strong>{{ $product->id }}</strong></td>
                    <td>
                        @if ($product->thumbnail)
                            <img src="{{ asset('uploads/' . $product->thumbnail) }}"
                                 alt="Thumbnail"
                                 style="width: 60px; height: 60px; object-fit: cover; border-radius: 6px;">
                        @else
                            <span class="text-muted">Không có ảnh</span>
                        @endif
                    </td>
                    <td>{{ $product->title }}</td>
                    <td class="text-success">{{ number_format($product->price, 0, ',', '.') }} ₫</td>
                    <td class="text-danger">
                        @if ($product->sale_price)
                            {{ number_format($product->sale_price, 0, ',', '.') }} ₫
                        @else
                            <span class="text-muted">-</span>
                        @endif
                    </td>
                    <td>
                        @if ($product->status == 'published')
                            <span class="badge bg-success">Đã xuất bản</span>
                        @elseif ($product->status == 'draft')
                            <span class="badge bg-secondary">Bản nháp</span>
                        @else
                            <span class="badge bg-warning text-dark">Lên lịch</span>
                        @endif
                    </td>
                    <td class="text-center">
                        <a href="{{ route('admin.product.edit', $product->id) }}" class="btn btn-sm btn-warning">
                            ✏ Sửa
                        </a>
                        <form action="{{ route('admin.product.destroy', $product->id) }}" method="POST" class="d-inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit"
                                    class="btn btn-sm btn-danger"
                                    onclick="return confirm('Bạn chắc chắn muốn xóa?')">
                                🗑 Xóa
                            </button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="7" class="text-center text-muted">Không có sản phẩm nào.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>

<div class="mt-3">
    {{ $products->links() }}
</div>
@endsection
