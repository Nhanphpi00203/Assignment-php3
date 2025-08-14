@extends('client.layouts.master')

@section('content')
<div class="container my-5">
    <h2 class="mb-4 text-success fw-bold display-6">Giỏ hàng của bạn</h2>

    @if(count((array) $cartItems) === 0)
        <div class="alert alert-info mb-4">Giỏ hàng của bạn đang trống.</div>
        <a href="{{ route('client.home') }}" class="btn btn-success">Tiếp tục mua sắm</a>
    @else
        <div class="table-responsive">
            <table class="table align-middle table-bordered shadow-sm">
                <thead class="table-success">
                    <tr>
                        <th>Sản phẩm</th>
                        <th>Đơn giá</th>
                        <th class="text-center" style="width:120px;">Số lượng</th>
                        <th>Thành tiền</th>
                        <th style="width:60px;"></th>
                    </tr>
                </thead>
                <tbody>
                    @php $total = 0; @endphp
                    @foreach($cartItems as $item)
                        @php
                            $originalPrice = (float) $item['price']; // Original price
                            $salePrice = isset($item['sale_price']) && $item['sale_price'] > 0 && $item['sale_price'] < $originalPrice ? $originalPrice - $item['sale_price'] : $originalPrice;
                            $subtotal = $salePrice * $item['quantity'];
                            $total += $subtotal;
                        @endphp

                        <tr>
                            <td class="d-flex align-items-center gap-3">
                                <img src="{{ $item['thumbnail'] }}"
                                     alt="{{ $item['name'] }}"
                                     class="rounded"
                                     style="width:80px; height:60px; object-fit:cover;">
                                <span>{{ $item['name'] }}</span>
                            </td>
                            <td>
                                @if(isset($item['sale_price']) && $item['sale_price'] > 0 && $item['sale_price'] < $originalPrice)
                                    <span class="text-success">{{ number_format($salePrice, 0, ',', '.') }} VNĐ</span>
                                    <br>
                                    <span class="text-muted text-decoration-line-through">{{ number_format($originalPrice, 0, ',', '.') }} VNĐ</span>
                                @else
                                    <span class="text-success">{{ number_format($salePrice, 0, ',', '.') }} VNĐ</span>
                                @endif
                            </td>
                            <td>
                                <form action="{{ route('cart.update', $item['id']) }}" method="POST" class="d-flex align-items-center gap-2">
                                    @csrf
                                    @method('PUT')
                                    <input type="number" name="quantity" value="{{ $item['quantity'] }}" min="1" class="form-control form-control-sm text-center" style="width:60px;">
                                    <button type="submit" class="btn btn-sm btn-success">Cập nhật</button>
                                </form>
                            </td>
                            <td class="fw-semibold">
                                @if(isset($item['sale_price']) && $item['sale_price'] > 0 && $item['sale_price'] < $originalPrice)
                                    <span class="text-success">{{ number_format($subtotal, 0, ',', '.') }} VNĐ</span>
                                    <br>
                                    <span class="text-muted text-decoration-line-through">{{ number_format($originalPrice * $item['quantity'], 0, ',', '.') }} VNĐ</span>
                                @else
                                    <span class="text-success">{{ number_format($subtotal, 0, ',', '.') }} VNĐ</span>
                                @endif
                            </td>
                            <td>
                                <form action="{{ route('cart.remove', $item['id']) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-outline-danger" title="Xóa">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                    <tr class="fw-bold">
                        <td colspan="3" class="text-end">Tổng cộng:</td>
                        <td><span class="text-success">{{ number_format($total, 0, ',', '.') }} VNĐ</span></td>
                        <td></td>
                    </tr>
                </tbody>
            </table>
        </div>

        <div class="d-flex justify-content-between mt-4">
            <a href="{{ route('client.home') }}" class="btn btn-outline-success">Tiếp tục mua sắm</a>
            <a href="{{ route('checkout.form') }}" class="btn btn-success">Thanh toán</a>
        </div>
    @endif
</div>
@endsection
