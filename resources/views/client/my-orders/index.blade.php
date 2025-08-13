@extends('client.layouts.master')

@section('title', 'Đơn hàng của tôi')

@section('content')
<div class="container mt-5">
    <div class="card shadow-sm">
        <div class="card-header bg-primary text-white">
            <h2 class="h4 mb-0">Đơn hàng của tôi</h2>
        </div>
        <div class="card-body">
            @if (session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif
            @if (session('error'))
                <div class="alert alert-danger">{{ session('error') }}</div>
            @endif

            @if ($orders->isEmpty())
                <div class="text-center py-5">
                    <i class="bi bi-cart-x fs-1 text-muted"></i>
                    <p class="mt-3 mb-0">Bạn chưa có đơn hàng nào.</p>
                </div>
            @else
                <div class="table-responsive">
                    <table class="table table-hover align-middle">
                        <thead class="table-light">
                            <tr>
                                <th>ID</th>
                                <th>Tổng tiền</th>
                                <th>Trạng thái</th>
                                <th>Chi tiết</th>
                                <th>Hành động</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($orders as $order)
                                <tr>
                                    <td>{{ $order->id }}</td>
                                    <td>
                                        <span class="badge bg-success">
                                            {{ number_format($order->total_price ?? 0, 0, ',', '.') }} VNĐ
                                        </span>
                                    </td>
                                    <td>
                                        @if ($order->status === 'pending')
                                            <span class="badge bg-warning text-dark">Chờ xác nhận</span>
                                        @elseif ($order->status === 'confirmed')
                                            <span class="badge bg-info text-dark">Đã xác nhận</span>
                                        @elseif ($order->status === 'cancelled')
                                            <span class="badge bg-danger">Đã hủy</span>
                                        @else
                                            <span class="badge bg-secondary">{{ $order->status }}</span>
                                        @endif
                                    </td>
                                    <td>
                                        <a href="{{ route('client.my-order-details', $order->id) }}" class="btn btn-sm btn-outline-primary">
                                            <i class="bi bi-eye"></i> Xem chi tiết
                                        </a>
                                    </td>
                                    <td>
                                        @if ($order->status === 'pending')
                                            <a href="{{ route('client.my-order-cancel', $order->id) }}" class="btn btn-sm btn-outline-danger" onclick="return confirm('Bạn chắc chắn muốn hủy đơn hàng này?')">
                                                <i class="bi bi-x-circle"></i> Hủy
                                            </a>
                                        @else
                                            <span class="text-muted">Không thể hủy</span>
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="d-flex justify-content-center mt-4">
                    {{ $orders->links() }}
                </div>
            @endif
        </div>
    </div>
</div>
@endsection
