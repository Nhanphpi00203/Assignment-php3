@extends('admin.layouts.master')

@section('content')
<div class="container py-4">
    <h1 class="mb-4 fw-bold">Admin Dashboard</h1>

    <div class="row g-4">
        <div class="col-md-3">
            <div class="card shadow-sm border-0">
                <div class="card-body text-center">
                    <h5 class="card-title text-muted">Người dùng</h5>
                    <p class="display-6 fw-bold text-primary">{{ $totalUsers }}</p>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card shadow-sm border-0">
                <div class="card-body text-center">
                    <h5 class="card-title text-muted">Sản phẩm</h5>
                    <p class="display-6 fw-bold text-success">{{ $totalProducts }}</p>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card shadow-sm border-0">
                <div class="card-body text-center">
                    <h5 class="card-title text-muted">Danh mục</h5>
                    <p class="display-6 fw-bold text-warning">{{ $totalCategories }}</p>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card shadow-sm border-0">
                <div class="card-body text-center">
                    <h5 class="card-title text-muted">Bình luận</h5>
                    <p class="display-6 fw-bold text-danger">{{ $totalComments }}</p>
                </div>
            </div>
        </div>
    </div>

    <div class="row g-4 mt-4">
        <div class="col-md-6">
            <div class="card shadow-sm border-0">
                <div class="card-header bg-white fw-bold">Thống kê sản phẩm theo danh mục</div>
                <div class="card-body">
                    <canvas id="categoryChart"></canvas>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card shadow-sm border-0">
                <div class="card-header bg-white fw-bold">Tỉ lệ người dùng</div>
                <div class="card-body">
                    <canvas id="userChart"></canvas>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Chart.js -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    const ctxCategory = document.getElementById('categoryChart').getContext('2d');
    new Chart(ctxCategory, {
        type: 'bar',
        data: {
            labels: @json($categoryLabels),
            datasets: [{
                label: 'Số sản phẩm',
                data: @json($categoryData),
                backgroundColor: '#4e73df',
                borderRadius: 5
            }]
        },
        options: {
            responsive: true,
            plugins: { legend: { display: false } }
        }
    });

    const ctxUser = document.getElementById('userChart').getContext('2d');
    new Chart(ctxUser, {
        type: 'pie',
        data: {
            labels: ['Admin', 'User'],
            datasets: [{
                data: [{{ $userStats['admin'] }}, {{ $userStats['user'] }}],
                backgroundColor: ['#1cc88a', '#36b9cc']
            }]
        },
        options: {
            responsive: true
        }
    });
</script>
@endsection
