@extends('client.layouts.master')

@section('content')
<div class="container my-5">
    <h2 class="fw-bold text-success mb-4">Thanh toán</h2>

    @if(session('error'))
        <div class="alert alert-danger">{{ session('error') }}</div>
    @endif

    <form action="{{ route('checkout.submit') }}" method="POST" class="mb-4">
        @csrf

        <div class="mb-3">
            <label for="name" class="form-label fw-semibold">Họ và tên</label>
            <input type="text" id="name" name="name" value="{{ old('name') }}" class="form-control @error('name') is-invalid @enderror" required>
            @error('name')<div class="invalid-feedback">{{ $message }}</div>@enderror
        </div>

        <div class="mb-3">
            <label for="email" class="form-label fw-semibold">Email</label>
            <input type="email" id="email" name="email" value="{{ old('email') }}" class="form-control @error('email') is-invalid @enderror" required>
            @error('email')<div class="invalid-feedback">{{ $message }}</div>@enderror
        </div>

        <div class="mb-3">
            <label for="phone" class="form-label fw-semibold">Số điện thoại</label>
            <input type="text" id="phone" name="phone" value="{{ old('phone') }}" class="form-control @error('phone') is-invalid @enderror" required>
            @error('phone')<div class="invalid-feedback">{{ $message }}</div>@enderror
        </div>

        <div class="mb-3">
            <label for="address" class="form-label fw-semibold">Địa chỉ giao hàng</label>
            <textarea id="address" name="address" rows="3" class="form-control @error('address') is-invalid @enderror" required>{{ old('address') }}</textarea>
            @error('address')<div class="invalid-feedback">{{ $message }}</div>@enderror
        </div>

        <h4 class="fw-semibold mb-3">Thông tin đơn hàng</h4>
        <ul class="list-group mb-4">
            @php $total = 0; @endphp
            @foreach($cartItems as $item)
                @php $subtotal = $item['price'] * $item['quantity']; $total += $subtotal; @endphp
                <li class="list-group-item d-flex justify-content-between align-items-center">
                    {{ $item['title'] }} x {{ $item['quantity'] }}
                    <span>{{ number_format($subtotal, 0, ',', '.') }} VNĐ</span>
                </li>
            @endforeach
            <li class="list-group-item d-flex justify-content-between fw-bold">
                Tổng cộng
                <span class="text-danger">{{ number_format($total, 0, ',', '.') }} VNĐ</span>
            </li>
        </ul>

        <button type="submit" class="btn btn-success rounded-pill px-4">Đặt hàng</button>
        <a href="{{ route('cart.show') }}" class="btn btn-outline-secondary rounded-pill px-4 ms-3">Quay lại giỏ hàng</a>
    </form>
</div>
@endsection
