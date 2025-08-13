@extends('client.layouts.master')

@section('content')

{{-- Import các thư viện cần thiết --}}
<link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
<link href="https://cdn.jsdelivr.net/npm/daisyui@2.51.5/dist/full.css" rel="stylesheet">
<link href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" rel="stylesheet">
<link href="https://cdnjs.cloudflare.com/ajax/libs/hover.css/2.3.2/css/hover-min.css" rel="stylesheet">
<link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
<script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>

<div class="container mx-auto my-10 px-4">

    <div class="grid grid-cols-1 lg:grid-cols-2 gap-8 items-start">

        {{-- Hình ảnh sản phẩm --}}
        <div data-aos="fade-right">
            <div class="border rounded-lg shadow-lg overflow-hidden bg-white animate__animated animate__fadeIn hvr-grow">
                <img src="{{ $product->thumbnail ? asset('storage/' . $product->thumbnail) : 'https://via.placeholder.com/600x400' }}"
                     alt="{{ $product->title }}"
                     class="w-full object-cover"
                     style="max-height: 450px;">
            </div>
        </div>

        {{-- Thông tin sản phẩm --}}
        <div data-aos="fade-left">
            <h1 class="text-3xl font-bold text-gray-800 mb-4">{{ $product->title }}</h1>

            {{-- Giá & giảm giá --}}
            <div class="mb-4">
                @if($product->sale_price > 0)
                    <div class="text-2xl font-bold text-red-600">
                        {{ number_format($product->price, 0, ',', '.') }} <span class="text-lg">VNĐ</span>
                    </div>
                    <div class="line-through text-gray-500">
                        {{ number_format($product->sale_price, 0, ',', '.') }} VNĐ
                    </div>
                @else
                    <div class="text-2xl font-bold text-green-600">
                        {{ number_format($product->price, 0, ',', '.') }} <span class="text-lg">VNĐ</span>
                    </div>
                @endif
            </div>

            {{-- Mô tả ngắn --}}
            <p class="text-gray-600 leading-relaxed mb-6">
                {{ $product->description }}
            </p>

            {{-- Form thêm giỏ hàng --}}
            <form action="{{ route('cart.add', $product->id) }}" method="POST">
                @csrf
                <button type="submit"
                    class="btn btn-success rounded-full px-6 py-3 shadow-lg flex items-center gap-2 hvr-bounce-to-right">
                    <x-heroicon-o-shopping-cart class="w-5 h-5" /> Thêm vào giỏ hàng
                </button>
            </form>
        </div>
    </div>

    {{-- Thông tin chi tiết sản phẩm --}}
    <div class="mt-12" data-aos="fade-up">
        <h4 class="text-xl font-bold border-b pb-2 mb-4">Thông tin chi tiết</h4>
        <p class="text-gray-600 leading-relaxed">
            {!! nl2br(e($product->description)) !!}
        </p>
    </div>

</div>

<script>
    AOS.init();
</script>

@endsection
