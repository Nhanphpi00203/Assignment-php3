@extends('client.layouts.master')

@section('content')
<div class="container my-5">
	<h2 class="mb-4 text-success fw-bold display-6">Giỏ hàng của bạn</h2>

	@if(count($cartItems) === 0)
		<div class="alert alert-info mb-4">Giỏ hàng của bạn đang trống.</div>
		<a href="{{ url('/') }}" class="btn btn-success">Tiếp tục mua sắm</a>
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
							$subtotal = $item['price'] * $item['quantity'];
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
							<td>{{ number_format($item['price'], 0, ',', '.') }} VNĐ</td>
							<td>
								<form action="{{ route('cart.update', $item['id']) }}" method="POST" class="d-flex align-items-center gap-2">
									@csrf
									@method('PUT')
									<input type="number" name="quantity" value="{{ $item['quantity'] }}" min="1" class="form-control form-control-sm text-center" style="width:60px;">
									<button type="submit" class="btn btn-sm btn-success">Cập nhật</button>
								</form>
							</td>
							<td class="fw-semibold text-danger">{{ number_format($subtotal, 0, ',', '.') }} VNĐ</td>
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
					<tr class="fw-bold text-danger">
						<td colspan="3" class="text-end">Tổng cộng:</td>
						<td>{{ number_format($total, 0, ',', '.') }} VNĐ</td>
						<td></td>
					</tr>
				</tbody>
			</table>
		</div>

		<div class="d-flex justify-content-between mt-4">
			<a href="{{ url('/') }}" class="btn btn-outline-success">Tiếp tục mua sắm</a>
			<a href="{{ route('checkout.form') }}" class="btn btn-success">Thanh toán</a>
		</div>
	@endif
</div>
@endsection
