{{-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

<ul class="list-group list-group-horizontal flex-wrap gap-3 my-3">
	@foreach ($categories as $cat)
		<li class="list-group-item rounded shadow-sm border-0 px-4 py-2 flex-fill text-center">
			<a href="/tin-trong-loai/{{$cat->id}}" class="text-decoration-none text-dark fw-semibold">
				{{ $cat->name }}
			</a>
		</li>
	@endforeach
</ul> --}}
{{-- @extends('client.layouts.master')

@section('content')
<div class="container my-5">

    <!-- Banner -->
    <div class="row align-items-center mb-5">
        <div class="col-md-12 text-center">
            <h1 class="display-5 fw-bold">Chào mừng đến với cửa hàng của chúng tôi!</h1>
            <p class="lead">Khám phá các sản phẩm mới nhất, ưu đãi hấp dẫn và nhiều danh mục đa dạng.</p>
            <a href="#products" class="btn btn-primary btn-lg mt-3">Mua ngay</a>
        </div>
    </div>

    <!-- Danh mục sản phẩm -->
    <h2 class="mb-4">Danh mục sản phẩm</h2>
    <div class="d-flex flex-wrap gap-3 mb-5">
        @foreach($categories as $category)
            <a href="{{ route('client.category.show', $category->slug) }}"
               class="badge bg-light text-dark border p-3 fs-6 shadow-sm text-decoration-none">
                {{ $category->name }}
            </a>
        @endforeach
    </div>

    <!-- Sản phẩm nổi bật -->
    <h2 id="products" class="mb-4">Sản phẩm nổi bật</h2>
    <div class="row row-cols-1 row-cols-md-3 g-4">
        @foreach($products as $product)
        <div class="col">
            <div class="card h-100 shadow-sm text-center">
                @if($product->thumbnail)
                    <img src="{{ asset('storage/' . $product->thumbnail) }}" class="card-img-top" alt="{{ $product->title }}">
                @else
                    <img src="https://via.placeholder.com/300x200" class="card-img-top" alt="No Image">
                @endif
                <div class="card-body">
                    <h5 class="card-title">{{ $product->title }}</h5>
                    <p class="card-text text-muted">{{ Str::limit($product->description, 80) }}</p>

                    @if($product->sale_price > 0)
                        <div class="fw-bold text-danger mb-2">
                            {{ number_format($product->sale_price, 0, ',', '.') }}₫
                            <small class="text-muted text-decoration-line-through ms-2">
                                {{ number_format($product->price, 0, ',', '.') }}₫
                            </small>
                        </div>
                    @else
                        <div class="fw-bold text-primary mb-2">
                            {{ number_format($product->price, 0, ',', '.') }}₫
                        </div>
                    @endif

                    <a href="{{ route('client.products.list', $product->slug) }}" class="btn btn-outline-primary">Xem chi tiết</a>
                </div>
            </div>
        </div>
        @endforeach
    </div>
</div>
@endsection --}}
{{--
<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>Trang chủ</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .price { color: #e74c3c; font-weight: bold; }
        .product-card img { height: 200px; object-fit: cover; }
        header { background: #00B207; padding: 15px; }
        header h1, header a { color: white; }
        header a { margin: 0 10px; text-decoration: none; font-weight: bold; }
        header a:hover { text-decoration: underline; }
    </style>
</head>
<body>

<header>
    <div class="container">
        <h1>Trang Chủ</h1>
        <nav>
            @foreach($categories as $cat)
                <a href="{{ url('category/'.$cat->id) }}">{{ $cat->name }}</a>
            @endforeach
        </nav>
    </div>
</header>

<div class="container my-4">
    <h2 class="mb-3">Sản phẩm mới nhất</h2>
    <div class="row g-3">
        @foreach($products as $p)
    <div class="product-card">
        <img src="{{ asset('storage/' . $p->thumbnail) }}" alt="{{ $p->title }}" width="200">
        <h5>{{ $p->title }}</h5>
        <p>
            {{ number_format($p->sale_price > 0 ? $p->sale_price : $p->price, 0, ',', '.') }} VNĐ
        </p>
    </div>
@endforeach

    </div>
</div>

</body>
</html> --}}
@extends('client.layouts.master')

@section('content')
<div class="container my-5">

	<!-- Banner -->
	<div class="mb-5">
		<div class="banner position-relative overflow-hidden rounded shadow">
			<img src="{{ asset('assets/images/traicay.jpg') }}" class="w-100 rounded" alt="Banner" style="max-height: 350px; object-fit: cover;">
			<div class="position-absolute top-50 start-50 translate-middle text-center text-white px-3" style="background: rgba(0,0,0,0.35); border-radius: 16px;">
				<h1 class="fw-bold display-4 mb-2" style="text-shadow: 0 2px 8px #000;">Chào mừng đến với cửa hàng</h1>
				<p class="lead mb-3" style="text-shadow: 0 1px 6px #000;">Khám phá sản phẩm mới nhất với ưu đãi hấp dẫn</p>
				<a href="#" class="btn btn-success btn-lg px-4 shadow">Mua ngay</a>
			</div>
		</div>
	</div>

	<!-- Danh mục sản phẩm -->
	<div class="d-flex flex-wrap gap-2 justify-content-center mb-4">
		@foreach($categories as $cat)
			<a href="{{ url('category/'.$cat->id) }}" class="btn btn-outline-success rounded-pill px-4 py-2 fw-semibold shadow-sm">
				{{ $cat->name }}
			</a>
		@endforeach
	</div>

	<!-- Tiêu đề -->
	<div class="d-flex justify-content-between align-items-center mb-4">
		<h2 class="fw-bold text-success mb-0">Sản phẩm mới nhất</h2>
		<a href="#" class="btn btn-outline-success btn-sm rounded-pill px-3">Xem tất cả</a>
	</div>

	<!-- Danh sách sản phẩm -->
	<div class="row g-4">
		@foreach($products as $p)
			<div class="col-12 col-sm-6 col-md-4 col-lg-3">
				<div class="card h-100 shadow-sm border-0 product-card position-relative">
					<div class="overflow-hidden rounded-top position-relative">
						<img src="{{ $p->thumbnail && filter_var($p->thumbnail, FILTER_VALIDATE_URL) ? $p->thumbnail : 'https://picsum.photos/640/480' }}" alt="{{ $p->title ?? 'No title' }}" class="w-100" style="height: 230px; object-fit: cover;">
						@if($p->sale_price > 0)
							<span class="badge bg-danger position-absolute top-0 start-0 m-2 px-2 py-1 shadow">Giảm giá</span>
						@endif
					</div>
					<div class="card-body d-flex flex-column">
						<h5 class="card-title fw-semibold text-truncate mb-2" title="{{ $p->title }}">
							{{ $p->title }}
						</h5>
						<p class="price mb-2">
							{{ number_format($p->sale_price > 0 ? $p->sale_price : $p->price, 0, ',', '.') }} VNĐ
							@if($p->sale_price > 0)
								<span class="text-muted text-decoration-line-through ms-2 small">{{ number_format($p->price, 0, ',', '.') }} VNĐ</span>
							@endif
						</p>
						<a href="#" class="btn btn-success mt-auto w-100 rounded-pill fw-semibold shadow-sm">Xem chi tiết</a>
					</div>
				</div>
			</div>
		@endforeach
	</div>
</div>
@endsection

@push('styles')
<style>
	.banner {
		background-color: #000;
		box-shadow: 0 8px 32px rgba(0,0,0,0.18);
	}
	.banner img {
		opacity: 0.85;
		filter: brightness(0.85);
	}
	.price {
		color: #e74c3c;
		font-weight: bold;
		font-size: 1.1rem;
		margin-bottom: 0;
	}
	.product-card {
		border-radius: 16px;
		transition: transform 0.2s, box-shadow 0.2s;
		background: #fff;
	}
	.product-card:hover {
		transform: translateY(-8px) scale(1.03);
		box-shadow: 0px 16px 32px rgba(0,0,0,0.12);
		z-index: 2;
	}
	.card-title {
		font-size: 1.1rem;
		color: #222;
	}
	.btn-success, .btn-outline-success {
		transition: box-shadow 0.2s, background 0.2s;
	}
	.btn-success:hover, .btn-outline-success:hover {
		box-shadow: 0 4px 16px rgba(0,178,7,0.15);
		background: #00B207;
		color: #fff;
	}
</style>
@endpush



