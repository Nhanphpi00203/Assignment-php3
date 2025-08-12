@extends('client.layouts.master')

@section('content')
<div class="container my-5">
    <h2 class="fw-bold text-success mb-4">Danh sách sản phẩm</h2>

    <div class="row g-4">
        @foreach ($products as $product)
            <div class="col-12 col-sm-6 col-md-4 col-lg-3">
                <div class="card h-100 shadow-sm border-0">
                    <img src="{{ $product->thumbnail ? asset('storage/' . $product->thumbnail) : 'https://via.placeholder.com/300x200' }}"
                         class="card-img-top" alt="{{ $product->title }}" style="height: 200px; object-fit: cover;">
                    <div class="card-body d-flex flex-column">
                        <h5 class="card-title text-truncate" title="{{ $product->title }}">{{ $product->title }}</h5>
                        <p class="fw-bold text-danger mb-2">
                            {{ number_format($product->sale_price > 0 ? $product->sale_price : $product->price, 0, ',', '.') }} VNĐ
                            @if($product->sale_price > 0)
                                <span class="text-muted text-decoration-line-through ms-2 small">{{ number_format($product->price, 0, ',', '.') }} VNĐ</span>
                            @endif
                        </p>
                        <a href="{{ route('client.sanpham.detail', $product->id) }}" class="btn btn-outline-success mt-auto">Xem chi tiết</a>
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
