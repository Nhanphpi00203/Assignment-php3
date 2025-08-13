@extends('admin.layouts.master')

@section('title', 'Thêm đơn hàng')

@section('content')
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Thêm đơn hàng</h1>
    </div>

    <form method="POST" action="{{ route('admin.order.store') }}">
        @csrf
        <div class="mb-3">
            <label for="user_id" class="form-label">Người dùng</label>
            <select class="form-select" id="user_id" name="user_id" required>
                @foreach ($users as $user)
                    <option value="{{ $user->id }}">{{ $user->name }}</option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label for="customer_name" class="form-label">Tên khách hàng</label>
            <input type="text" class="form-control" id="customer_name" name="customer_name" value="{{ old('customer_name') }}" required>
        </div>

        <div class="mb-3">
            <label for="customer_email" class="form-label">Email khách hàng</label>
            <input type="email" class="form-control" id="customer_email" name="customer_email" value="{{ old('customer_email') }}" required>
        </div>

        <div class="mb-3">
            <label for="customer_phone" class="form-label">Số điện thoại</label>
            <input type="text" class="form-control" id="customer_phone" name="customer_phone" value="{{ old('customer_phone') }}" required>
        </div>

        <div class="mb-3">
            <label for="customer_addr" class="form-label">Địa chỉ</label>
            <input type="text" class="form-control" id="customer_addr" name="customer_addr" value="{{ old('customer_addr') }}" required>
        </div>

        <div class="mb-3">
            <label for="total_price" class="form-label">Tổng tiền</label>
            <input type="number" class="form-control" id="total_price" name="total_price" step="0.01" value="{{ old('total_price') }}" required>
        </div>

        <div class="mb-3">
            <label for="status" class="form-label">Trạng thái</label>
						<select class="form-select" id="status" name="status" required>
							<option value="pending" {{ old('status') == 'pending' ? 'selected' : '' }}>Chờ xử lý</option>
							<option value="processing" {{ old('status') == 'processing' ? 'selected' : '' }}>Đang xử lý</option>
							<option value="completed" {{ old('status') == 'completed' ? 'selected' : '' }}>Hoàn thành</option>
							<option value="cancelled" {{ old('status') == 'cancelled' ? 'selected' : '' }}>Đã hủy</option>
						</select>
        </div>

        <button type="submit" class="btn btn-primary">Thêm</button>
    </form>
@endsection
