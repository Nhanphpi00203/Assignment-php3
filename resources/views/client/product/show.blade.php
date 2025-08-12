@extends('client.layouts.master')

@section('content')
<div class="container my-5">
    <div class="row g-4">
        <div class="col-md-6">
            <img src="{{ $product->thumbnail ? asset('storage/' . $product->thumbnail) : 'https://via.placeholder.com/600x400' }}"
                 class="img-fluid rounded" alt="{{ $product->title }}">
        </div>
        <div class="col-md-6">
            <h1 class="fw-bold text-success">{{ $product->title }}</h1>
            <p class="fs-5 fw-bold text-danger">
                {{ number_format($product->sale_price > 0 ? $product->sale_price : $product->price, 0, ',', '.') }} VNĐ
                @if($product->sale_price > 0)
                    <span class="text-muted text-decoration-line-through ms-2 small">{{ number_format($product->price, 0, ',', '.') }} VNĐ</span>
                @endif
            </p>
            <p>{{ $product->description }}</p>

            <form action="{{ route('client.cart.add', $product->id) }}" method="POST" class="mt-4">
                @csrf
                <button type="submit" class="btn btn-success rounded-pill px-4">Thêm vào giỏ hàng</button>
            </form>
        </div>
    </div>
</div>
@endsection
