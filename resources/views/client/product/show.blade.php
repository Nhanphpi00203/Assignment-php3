@extends('client.layouts.master')

@section('content')
    <div class="container my-5">
        <div class="row g-5 align-items-start">
            {{-- Hình ảnh sản phẩm --}}
            <div class="col-lg-6">
                <div class="border rounded shadow-sm overflow-hidden bg-white animate__animated animate__fadeInLeft">
                    <img src="{{ $product->thumbnail ? asset('storage/' . $product->thumbnail) : 'https://via.placeholder.com/600x400' }}"
                         class="img-fluid w-100"
                         style="object-fit: cover; max-height: 450px;"
                         alt="{{ $product->title }}">
                </div>
            </div>

            {{-- Thông tin sản phẩm --}}
            <div class="col-lg-6 animate__animated animate__fadeInRight">
                <h1 class="fw-bold text-dark mb-3">{{ $product->title }}</h1>

                {{-- Giá & giảm giá --}}
                <div class="my-3">
                    @if($product->sale_price > 0)
                        <div class="fs-3 fw-bold text-danger">
                            {{ number_format($product->price, 0, ',', '.') }} <span class="fs-5">VNĐ</span>
                        </div>
                        <div class="text-muted text-decoration-line-through">
                            {{ number_format($product->sale_price, 0, ',', '.') }} VNĐ
                        </div>
                    @else
                        <div class="fs-3 fw-bold text-success">
                            {{ number_format($product->price, 0, ',', '.') }} <span class="fs-5">VNĐ</span>
                        </div>
                    @endif
                </div>

                {{-- Mô tả ngắn --}}
                <p class="text-secondary" style="line-height: 1.8;">
                    {{ $product->description }}
                </p>

                {{-- Form thêm giỏ hàng --}}
                <form action="{{ route('cart.add', $product->id) }}" method="POST" class="mt-4">
                    @csrf
                    <button type="submit" class="btn btn-success btn-lg rounded-pill px-5 py-2 shadow-sm">
                        <i class="bi bi-cart-plus me-2"></i> Thêm vào giỏ hàng
                    </button>
                </form>
            </div>
        </div>

        {{-- Thông tin chi tiết sản phẩm --}}
        <div class="mt-5 animate__animated animate__fadeInUp">
            <h4 class="fw-bold border-bottom pb-2">Thông tin chi tiết</h4>
            <p class="mt-3 text-secondary">
                {!! nl2br(e($product->description)) !!}
            </p>
        </div>

        {{-- Sản phẩm cùng danh mục --}}
        @if($relatedProducts->count() > 0)
            <div class="mt-5 animate__animated animate__fadeInUp">
                <h4 class="fw-bold border-bottom pb-2">Sản phẩm cùng danh mục</h4>
                <div class="row g-4 mt-3">
                    @foreach($relatedProducts as $item)
                        <div class="col-md-3 col-sm-6">
                            <div class="card h-100 border-0 shadow-sm position-relative product-card transition-all">
                                @if($item->sale_price > 0)
                                    @php
                                        $discountPercent = round((($item->price - $item->sale_price) / $item->price) * 100);
                                    @endphp
                                    <span class="badge bg-danger position-absolute top-0 start-0 m-2 px-2 py-1">
                                        -{{ $discountPercent }}%
                                    </span>
                                @endif
                                <img src="{{ $item->thumbnail ? asset('storage/' . $item->thumbnail) : 'https://via.placeholder.com/300x200' }}"
                                     class="card-img-top"
                                     style="object-fit: cover; height: 180px;"
                                     alt="{{ $item->title }}">
                                <div class="card-body">
                                    <h6 class="card-title text-truncate">{{ $item->title }}</h6>
                                    <p class="text-danger fw-bold mb-1">
                                        {{ number_format($item->sale_price > 0 ? $item->sale_price : $item->price, 0, ',', '.') }} VNĐ
                                    </p>
                                    @if($item->sale_price > 0)
                                        <small class="text-muted text-decoration-line-through">
                                            {{ number_format($item->price, 0, ',', '.') }} VNĐ
                                        </small>
                                    @endif
                                </div>
                                <div class="card-footer bg-white border-0">
                                    <a href="{{ route('client.sanpham.detail', $item->id) }}" class="btn btn-outline-primary w-100">
                                        Xem chi tiết
                                    </a>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        @endif

        {{-- Phần bình luận --}}
        <div class="mt-5 animate__animated animate__fadeInUp">
            <h4 class="fw-bold border-bottom pb-2">Bình luận</h4>

            <!-- Danh sách bình luận -->
           @if($product->comments->where('status', 1)->count() > 0)
    <div class="mt-3">
        @foreach($product->comments->where('status', 1) as $comment)
            <div class="card mb-3 shadow-sm">
                <div class="card-body">
                    <h6 class="card-title mb-1">{{ $comment->user->name ?? 'Người dùng ẩn danh' }}</h6>
                    <small class="text-muted">{{ $comment->created_at->format('d/m/Y H:i') }}</small>
                    <p class="card-text mt-2">{{ $comment->content }}</p>
                </div>
            </div>
        @endforeach
    </div>
@else
    <p class="text-muted mt-3">Chưa có bình luận nào.</p>
@endif

            <!-- Form bình luận -->
            @if(auth()->check())
                <form action="{{ route('client.sanpham.comment.store', $product->id) }}" method="POST" class="mt-4">
                    @csrf
                    <div class="mb-3">
                        <label for="content" class="form-label">Viết bình luận của bạn</label>
                        <textarea name="content" id="content" class="form-control" rows="4" required></textarea>
                    </div>
                    <button type="submit" class="btn btn-success rounded-pill px-4">Gửi bình luận</button>
                </form>
            @else
                <p class="text-muted mt-3">Vui lòng <a href="{{ route('login') }}" class="text-decoration-none">đăng nhập</a> để bình luận.</p>
            @endif
        </div>

    </div>

    <!-- CSS tùy chỉnh -->
    <style>
        .product-card {
            transition: transform 0.2s ease-in-out, box-shadow 0.2s ease-in-out;
        }
        .product-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 20px rgba(0,0,0,0.15);
        }
    </style>

    <!-- Link Animate.css -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"/>
@endsection
