@extends('client.layouts.master')

@section('content')
<div class="container my-5">
    <h2>Thanh toán</h2>

    @if(session('error'))
        <div class="alert alert-danger">{{ session('error') }}</div>
    @endif

    <form action="{{ route('checkout.submit') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label>Họ và tên</label>
            <input type="text" name="name" class="form-control" required value="{{ old('name', auth()->user()->name ?? '') }}">
        </div>

        <div class="mb-3">
            <label>Email</label>
            <input type="email" name="email" class="form-control" required value="{{ old('email', auth()->user()->email ?? '') }}">
        </div>

        <div class="mb-3">
            <label>Số điện thoại</label>
            <input type="text" name="phone" class="form-control" required value="{{ old('phone') }}">
        </div>

        <div class="mb-3">
            <label>Địa chỉ</label>
            <input type="text" name="address" class="form-control" required value="{{ old('address') }}">
        </div>

        <h4>Giỏ hàng</h4>
        @php $total = 0; @endphp
        <table class="table table-bordered">
            <thead>
                <tr><th>Sản phẩm</th><th>Giá</th><th>Số lượng</th><th>Tổng</th></tr>
            </thead>
            <tbody>
                @forelse($cart as $id => $item)
                    @php
                        $price = $item['price'] ?? 0;
                        $qty = $item['quantity'] ?? 0;
                        $subtotal = $price * $qty;
                        $total += $subtotal;
                    @endphp
                    <tr>
                        <td>{{ $item['name'] ?? ($item['title'] ?? 'Sản phẩm') }}</td>
                        <td>{{ number_format($price, 0, ',', '.') }} VNĐ</td>
                        <td>{{ $qty }}</td>
                        <td>{{ number_format($subtotal, 0, ',', '.') }} VNĐ</td>
                    </tr>
                @empty
                    <tr><td colspan="4">Giỏ hàng trống</td></tr>
                @endforelse
                <tr>
                    <td colspan="3" class="text-end"><strong>Tổng</strong></td>
                    <td><strong>{{ number_format($total, 0, ',', '.') }} VNĐ</strong></td>
                </tr>
            </tbody>
        </table>

        <button type="submit" class="btn btn-success">Xác nhận thanh toán</button>
    </form>
</div>
@endsection
