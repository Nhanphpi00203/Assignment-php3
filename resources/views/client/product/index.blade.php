@extends('client.layouts.master')

@section('content')
    <div class="container my-5">
        <!-- Danh mục -->
        <!-- (Giữ nguyên phần này nếu có) -->

        <!-- Form lọc -->
        <div class="card shadow-sm mb-4 p-4">
            <h3 class="fw-bold text-success mb-3">Lọc sản phẩm</h3>
            <form action="{{ route('client.sanpham.list') }}" method="GET" class="row g-3">
                <!-- Lọc theo danh mục -->
                <div class="col-md-4">
                    <label for="category_id" class="form-label">Danh mục</label>
                    <select name="category_id" id="category_id" class="form-select">
                        <option value="">Tất cả</option>
                        @foreach ($categories as $category)
                            <option value="{{ $category->id }}" {{ request('category_id') == $category->id ? 'selected' : '' }}>
                                {{ $category->name }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <!-- Lọc theo giá -->
                <div class="col-md-4">
                    <label class="form-label">Giá</label>
                    <div class="row g-2">
                        <div class="col-6">
                            <input type="number" name="min_price" class="form-control" placeholder="Giá từ"
                                   value="{{ request('min_price') }}">
                        </div>
                        <div class="col-6">
                            <input type="number" name="max_price" class="form-control" placeholder="Giá đến"
                                   value="{{ request('max_price') }}">
                        </div>
                    </div>
                </div>

                <!-- Tìm kiếm -->
                <div class="col-md-4">
                    <label for="search" class="form-label">Tìm kiếm</label>
                    <input type="text" name="search" id="search" class="form-control" placeholder="Nhập từ khóa"
                           value="{{ request('search') }}">
                </div>

                <!-- Nút lọc -->
                <div class="col-12 text-end">
                    <button type="submit" class="btn btn-success">Lọc</button>
                    <a href="{{ route('client.sanpham.list') }}" class="btn btn-secondary ms-2">Xóa lọc</a>
                </div>
            </form>
        </div>

        <h2 class="fw-bold text-success mb-4">Danh sách sản phẩm</h2>

        <div class="row g-4">
            @foreach ($products as $product)
                <div class="col-12 col-sm-6 col-md-4 col-lg-3">
                    <div class="card h-100 shadow-sm border-0">
                        <div class="overflow-hidden rounded-top position-relative">
                            <img src="{{ $product->thumbnail && filter_var($product->thumbnail, FILTER_VALIDATE_URL) ? $product->thumbnail : 'https://picsum.photos/640/480' }}"
                                 alt="{{ $product->title ?? 'No title' }}"
                                 class="w-100"
                                 style="height: 230px; object-fit: cover;">

                            @if($product->sale_price > 0 && $product->sale_price < $product->price)
                                <span class="badge bg-danger position-absolute top-0 start-0 m-2 px-2 py-1 shadow">
                                    <span class="text-decoration-line-through me-2 small">
                                        {{ number_format($product->sale_price, 0, ',', '.') }} VNĐ
                                    </span>
                                    Giảm giá
                                </span>
                            @endif
                        </div>

                        <div class="card-body d-flex flex-column">
                            <h5 class="card-title text-truncate" title="{{ $product->title }}">
                                {{ $product->title }}
                            </h5>

                            <p class="price mb-2">
                                @if($product->sale_price > 0 && $product->sale_price < $product->price)
                                    <!-- Giá sau khi giảm (price - sale_price) với màu đỏ -->
                                    <span class="fw-bold text-danger">
                                        {{ number_format($product->price - $product->sale_price, 0, ',', '.') }} VNĐ
                                    </span>
                                @else
                                    <!-- Giá gốc với màu đỏ nếu không giảm giá -->
                                    <span class="fw-bold text-danger">
                                        {{ number_format($product->price, 0, ',', '.') }} VNĐ
                                    </span>
                                @endif
                            </p>

                            <a href="{{ route('client.sanpham.detail', $product->id) }}" class="btn btn-outline-success mt-auto">
                                Xem chi tiết
                            </a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        <div class="mt-4">
            {{ $products->links() }}
        </div>
    </div>
@endsection
