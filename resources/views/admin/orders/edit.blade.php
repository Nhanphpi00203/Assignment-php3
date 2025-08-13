@extends('admin.layouts.master')

@section('title', 'Sửa đơn hàng')

@section('content')
<div class="container py-4">

    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="fw-bold text-primary mb-0">
            <i class="bi bi-pencil-square me-2"></i> Sửa đơn hàng
        </h2>
        <a href="{{ route('admin.order.list') }}" class="btn btn-outline-secondary">
            <i class="bi bi-arrow-left"></i> Quay lại
        </a>
    </div>

    <div class="card shadow-sm border-0 rounded-3">
        <div class="card-body p-4">
            <form method="POST" action="{{ route('admin.order.update', $order->id) }}">
                @csrf
                @method('PUT')

                <div class="row g-3">
                    <div class="col-md-6">
                        <label for="user_id" class="form-label fw-semibold">Người dùng</label>
                        <select class="form-select" id="user_id" name="user_id" required>
                            @foreach ($users as $user)
                                <option value="{{ $user->id }}" {{ old('user_id', $order->user_id) == $user->id ? 'selected' : '' }}>
                                    {{ $user->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="col-md-6">
                        <label for="customer_name" class="form-label fw-semibold">Tên khách hàng</label>
                        <input type="text" class="form-control" id="customer_name" name="customer_name"
                               value="{{ old('customer_name', $order->customer_name) }}" required>
                    </div>

                    <div class="col-md-6">
                        <label for="customer_email" class="form-label fw-semibold">Email khách hàng</label>
                        <input type="email" class="form-control" id="customer_email" name="customer_email"
                               value="{{ old('customer_email', $order->customer_email) }}" required>
                    </div>

                    <div class="col-md-6">
                        <label for="customer_phone" class="form-label fw-semibold">Số điện thoại</label>
                        <input type="text" class="form-control" id="customer_phone" name="customer_phone"
                               value="{{ old('customer_phone', $order->customer_phone) }}" required>
                    </div>

                    <div class="col-12">
                        <label for="customer_addr" class="form-label fw-semibold">Địa chỉ</label>
                        <input type="text" class="form-control" id="customer_addr" name="customer_addr"
                               value="{{ old('customer_addr', $order->customer_addr) }}" required>
                    </div>

                    <div class="col-md-6">
                        <label for="total_price" class="form-label fw-semibold">Tổng tiền</label>
                        <input type="number" class="form-control" id="total_price" name="total_price" step="0.01"
                               value="{{ old('total_price', $order->total_price) }}" required>
                    </div>

                    <div class="col-md-6">
                        <label for="status" class="form-label fw-semibold">Trạng thái</label>
                        <select class="form-select" id="status" name="status" required>
                            <option value="pending" {{ old('status', $order->status) == 'pending' ? 'selected' : '' }}>Chờ xử lý</option>
                            <option value="processing" {{ old('status', $order->status) == 'processing' ? 'selected' : '' }}>Đang xử lý</option>
                            <option value="completed" {{ old('status', $order->status) == 'completed' ? 'selected' : '' }}>Hoàn thành</option>
                            <option value="cancelled" {{ old('status', $order->status) == 'cancelled' ? 'selected' : '' }}>Đã hủy</option>
                        </select>
                    </div>
                </div>

                <div class="mt-4 text-end">
                    <button type="submit" class="btn btn-success px-4">
                        <i class="bi bi-save me-1"></i> Cập nhật
                    </button>
                </div>
            </form>
        </div>
    </div>

</div>
@endsection
