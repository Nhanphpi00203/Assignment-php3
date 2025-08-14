@extends('client.layouts.master')

@section('title', 'Chi tiết đơn hàng')

@section('content')
<div class="container mt-5">
    <div class="card shadow-sm">
        <div class="card-header bg-primary text-white">
            <h2 class="h4 mb-0">Chi tiết đơn hàng #{{ $order->id }}</h2>
        </div>
        <div class="card-body">
            @if (session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif
            @if (session('error'))
                <div class="alert alert-danger">{{ session('error') }}</div>
            @endif

            <div class="table-responsive">
                <table class="table table-hover align-middle">
                    <thead class="table-light">
                        <tr>
                            <th>Sản phẩm</th>
                            <th>Đơn giá</th>
                            <th>Số lượng</th>
                            <th>Thành tiền</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                            $orderTotal = 0;
                            $originalOrderTotal = 0;
                            $discountOrderTotal = 0;
                        @endphp
                        @foreach ($order->orderItems as $item)
                            @php
                                $product = \App\Models\Product::find($item->product_id);
                                $originalPrice = (float) ($product ? $product->price : $item->price); // Original price
                                $finalPrice = (float) $item->price; // Final price (should be original - discount)
                                $quantity = (float) $item->quantity;
                                $itemOriginalTotal = $originalPrice * $quantity;
                                $itemFinalTotal = $finalPrice * $quantity;
                                $itemDiscount = $originalPrice > $finalPrice ? ($originalPrice - $finalPrice) * $quantity : 0;
                                $orderTotal += $itemFinalTotal;
                                $originalOrderTotal += $itemOriginalTotal;
                                $discountOrderTotal += $itemDiscount;
                            @endphp
                            <tr>
                                <td>{{ $item->product->title ?? 'Sản phẩm không xác định' }}</td>
                                <td>
                                    @if($originalPrice > $finalPrice)
                                        <span class="text-success">{{ number_format($finalPrice, 0, ',', '.') }} VNĐ</span>
                                        <br>
                                        <span class="text-muted text-decoration-line-through">{{ number_format($originalPrice, 0, ',', '.') }} VNĐ</span>
                                    @else
                                        <span class="text-success">{{ number_format($finalPrice, 0, ',', '.') }} VNĐ</span>
                                    @endif
                                </td>
                                <td>{{ $item->quantity }}</td>
                                <td class="fw-semibold">
                                    @if($originalPrice > $finalPrice)
                                        <span class="text-success">{{ number_format($itemFinalTotal, 0, ',', '.') }} VNĐ</span>
                                        <br>
                                        <span class="text-muted text-decoration-line-through">{{ number_format($itemOriginalTotal, 0, ',', '.') }} VNĐ</span>
                                    @else
                                        <span class="text-success">{{ number_format($itemFinalTotal, 0, ',', '.') }} VNĐ</span>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                        <tr class="fw-bold">
                            <td colspan="3" class="text-end">Tổng cộng:</td>
                            <td>
                                @if($discountOrderTotal > 0)
                                    <span class="text-success">{{ number_format($orderTotal, 0, ',', '.') }} VNĐ</span>
                                    <br>
                                    <span class="text-muted text-decoration-line-through">{{ number_format($originalOrderTotal, 0, ',', '.') }} VNĐ</span>
                                @else
                                    <span class="text-success">{{ number_format($orderTotal, 0, ',', '.') }} VNĐ</span>
                                @endif
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <div class="mt-4">
                <a href="{{ route('client.my-orders') }}" class="btn btn-outline-primary">Quay lại</a>
            </div>
        </div>
    </div>
</div>
@endsection
