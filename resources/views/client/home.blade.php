
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
				<li class="nav-item btn btn-success btn-lg px-4 shadow">
								<a class="nav-link {{ request()->routeIs('client.sanpham.list') ? 'active' : '' }}"
								href="{{ route('client.sanpham.list') }}">
								Mua ngay
								</a>
							</li>
				{{-- <a href="#" class="btn btn-success btn-lg px-4 shadow">Mua ngay</a> --}}
			</div>
		</div>
	</div>

	<!-- Danh mục sản phẩm -->
<div class="d-flex flex-wrap gap-2 justify-content-center mb-4">
    @foreach($categories->where('status', 1) as $cat)
        <a href="{{ route('client.sanpham.category', $cat->id) }}"
           class="btn btn-outline-success rounded-pill px-4 py-2 fw-semibold shadow-sm">
            {{ $cat->name }}
        </a>
    @endforeach
</div>



	<!-- Tiêu đề -->
	<div class="d-flex justify-content-between align-items-center mb-4">
		<h2 class="fw-bold text-success mb-0">Sản phẩm mới nhất</h2>
			<li class="btn btn-outline-success btn-sm rounded-pill px-3">
								<a class="nav-link {{ request()->routeIs('client.sanpham.list') ? 'active' : '' }}"
								href="{{ route('client.sanpham.list') }}">
								Xem tất cả
								</a>
							</li>
		{{-- <a href="#" class="btn btn-outline-success btn-sm rounded-pill px-3">Xem tất cả</a> --}}
	</div>

	<!-- Danh sách sản phẩm -->
	<div class="row g-4">
    @foreach($products as $p)
        <div class="col-12 col-sm-6 col-md-4 col-lg-3">
            <div class="card h-100 shadow-sm border-0 product-card position-relative">

                {{-- Ảnh sản phẩm --}}
                <div class="overflow-hidden rounded-top position-relative">
                    <img src="{{ $p->thumbnail && filter_var($p->thumbnail, FILTER_VALIDATE_URL) ? $p->thumbnail : 'https://picsum.photos/640/480' }}"
                         alt="{{ $p->title ?? 'No title' }}"
                         class="w-100"
                         style="height: 230px; object-fit: cover;">

                    {{-- Badge giảm giá --}}
                    @if($p->sale_price > 0 && $p->sale_price < $p->price)
                        <span class="badge bg-danger position-absolute top-0 start-0 m-2 px-2 py-1 shadow">
													<span class="text-muted text-decoration-line-through small">
                                {{ number_format($p->sale_price, 0, ',', '.') }} VNĐ
                            </span>
                            Giảm giá
                        </span>
                    @endif
                </div>

                {{-- Thông tin sản phẩm --}}
                <div class="card-body d-flex flex-column">
                    <h5 class="card-title fw-semibold text-truncate mb-2" title="{{ $p->title }}">
                        {{ $p->title }}
                    </h5>

                    {{-- Giá sản phẩm --}}
                    <p class="price mb-2">
                        @if($p->sale_price > 0 && $p->sale_price < $p->price)
                            {{-- Giá gốc --}}
                            <span class="text-danger fw-bold ms-2 ">
                                {{ number_format($p->price, 0, ',', '.') }} VNĐ
                            </span>
                            {{-- Giá giảm --}}
                            <span class="text-muted text-decoration-line-through small">
                                Giảm {{ number_format($p->sale_price, 0, ',', '.') }} VNĐ
                            </span>
                        @else
                            {{-- Chỉ có giá gốc --}}
                            <span class="fw-bold">
                                {{ number_format($p->price, 0, ',', '.') }} VNĐ
                            </span>
                        @endif
                    </p>

                    {{-- Nút xem chi tiết --}}
                    <a href="{{ route('client.sanpham.detail', $p->id) }}"
                       class="btn btn-success mt-auto w-100 rounded-pill fw-semibold shadow-sm">
                        Xem chi tiết
                    </a>
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



