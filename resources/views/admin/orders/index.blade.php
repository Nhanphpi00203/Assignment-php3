@extends('admin.layouts.master')

@section('title', 'Danh sách đơn hàng')

@section('content')
<div class="pt-3 pb-2 mb-4 border-bottom">
    <div class="d-flex justify-content-between align-items-center">
        <h1 class="h3 mb-0 fw-bold text-primary">
            📦 Danh sách đơn hàng
            <span class="badge bg-secondary">{{ $orders->total() }}</span>
        </h1>
        <a href="{{ route('admin.order.create') }}" class="btn btn-success shadow-sm">
            <i class="bi bi-plus-circle me-1"></i> Thêm đơn hàng
        </a>
    </div>
</div>

<div class="card shadow-sm border-0 rounded-3">
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table align-middle table-hover mb-0">
                <thead class="table-primary">
                    <tr>
                        <th>#</th>
                        <th>Người dùng</th>
                        <th>Tên khách hàng</th>
                        <th>Email</th>
                        <th>SĐT</th>
                        <th>Địa chỉ</th>
                        <th class="text-end">Tổng tiền</th>
                        <th class="text-center">Trạng thái</th>
                        <th class="text-center">Hành động</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($orders as $order)
                        <tr>
                            <td>{{ $order->id }}</td>
                            <td>{{ $order->user->name ?? 'N/A' }}</td>
                            <td class="fw-semibold">{{ $order->customer_name }}</td>
                            <td class="text-muted">{{ $order->customer_email }}</td>
                            <td>{{ $order->customer_phone }}</td>
                            <td>{{ $order->customer_addr }}</td>
                            <td class="text-end text-success fw-bold">
                                {{ number_format($order->total_price ?? 0, 0, ',', '.') }} ₫
                            </td>
                            <td class="text-center">
                                @if($order->status == 'pending')
                                    <span class="badge bg-warning text-dark">⏳ Chờ xử lý</span>
                                @elseif($order->status == 'completed')
                                    <span class="badge bg-success">✅ Hoàn thành</span>
                                @elseif($order->status == 'cancelled')
                                    <span class="badge bg-danger">❌ Đã hủy</span>
                                @else
                                    <span class="badge bg-secondary">{{ $order->status }}</span>
                                @endif
                            </td>
                            <td class="text-center">
                                <a href="{{ route('admin.order.edit', $order->id) }}"
                                   class="btn btn-sm btn-outline-warning me-1">
                                    <i class="bi bi-pencil-square"></i> Sửa
                                </a>
                                <form action="{{ route('admin.order.destroy', $order->id) }}"
                                      method="POST" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit"
                                            class="btn btn-sm btn-outline-danger"
                                            onclick="return confirm('Bạn chắc chắn muốn xóa đơn hàng này?')">
                                        <i class="bi bi-trash"></i> Xóa
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="9" class="text-center text-muted py-4">
                                <i class="bi bi-inbox"></i> Không có đơn hàng nào.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>

<div class="mt-3">
    {{ $orders->links('pagination::bootstrap-5') }}
</div>
@endsection
