@extends('client.layouts.master')

@section('title', 'Chi tiết đơn hàng')

@section('content')
<div class="container mt-5">
    <div class="card shadow-sm border-0 mb-4">
        <div class="card-header bg-primary text-white">
            <h2 class="h4 mb-0">Đơn hàng #{{ $order->id }}</h2>
        </div>
        <div class="card-body">
            <ul class="list-group list-group-flush mb-3">
                <li class="list-group-item"><strong>Tổng tiền:</strong>
                    <span class="text-danger fw-bold">{{ number_format($order->total_price ?? 0, 0, ',', '.') }} VNĐ</span>
                </li>
                <li class="list-group-item"><strong>Trạng thái:</strong>
                    <span class="badge
                        @if($order->status === 'pending') bg-warning text-dark
                        @elseif($order->status === 'completed') bg-success
                        @elseif($order->status === 'cancelled') bg-danger
                        @else bg-secondary
                        @endif
                    ">
                        @if($order->status === 'pending')
                            Chờ xác nhận
                        @elseif($order->status === 'completed')
                            Hoàn thành
                        @elseif($order->status === 'cancelled')
                            Đã hủy
                        @else
                            {{ $order->status }}
                        @endif
                    </span>
                </li>
            </ul>

            <h5>Sản phẩm trong đơn</h5>
            <div class="table-responsive">
                <table class="table table-bordered align-middle">
                    <thead class="table-light">
                        <tr>
                            <th>Tên sản phẩm</th>
                            <th class="text-center">Số lượng</th>
                            <th class="text-end">Giá</th>
                            <th class="text-end">Tổng</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($order->orderItems as $item)
                            <tr>
                                <td>{{ $item->name ?? 'N/A' }}</td>
                                <td class="text-center">{{ $item->quantity }}</td>
                                <td class="text-end">{{ number_format($item->price ?? 0, 0, ',', '.') }} VNĐ</td>
                                <td class="text-end">{{ number_format($item->price * $item->quantity, 0, ',', '.') }} VNĐ</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <div class="mt-3 d-flex justify-content-between">
                @if ($order->status === 'pending')
                    <a href="{{ route('client.my-order-cancel', $order->id) }}" class="btn btn-outline-danger" onclick="return confirm('Bạn chắc chắn muốn hủy đơn hàng này?')">
                        <i class="bi bi-x-circle"></i> Hủy đơn hàng
                    </a>
                @else
                    <span class="text-muted">Không thể hủy đơn hàng ở trạng thái này.</span>
                @endif
                <a href="{{ route('client.my-orders') }}" class="btn btn-secondary">
                    <i class="bi bi-arrow-left"></i> Quay lại
                </a>
            </div>
        </div>
    </div>
</div>
@endsection
