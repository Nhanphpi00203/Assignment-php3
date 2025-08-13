<!doctype html>
<html lang="en">

<head>
	<title>
		@yield('meta_title')
	</title>
	<meta charset="utf-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
		integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous" />
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css">
	<style>
		html, body {
			height: 100%;
		}
		body {
			min-height: 100vh;
			display: flex;
			flex-direction: column;
			background: #f8f9fa;
		}
		main {
			flex: 1 0 auto;
			padding-top: 32px;
			padding-bottom: 32px;
		}
		footer {
			flex-shrink: 0;
		}
		.navbar {
			box-shadow: 0 2px 8px rgba(0,0,0,0.04);
		}
		.navbar-brand img {
			border-radius: 6px;
		}
		.dropdown-menu {
			min-width: 180px;
		}
		.footer-link:hover {
			text-decoration: underline;
		}
	</style>
	@stack('style')
</head>
<body>
	<header>
		<nav class="navbar navbar-expand-lg navbar-light bg-white border-bottom py-3">
			<div class="container">
				<a class="navbar-brand fw-bold" href="{{ route('dashboard') }}">
					<img src="{{ asset('assets/images/logo-3.png') }}" alt="Logo" height="36">
				</a>
				<button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
					aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
					<span class="navbar-toggler-icon"></span>
				</button>

				<div class="collapse navbar-collapse" id="navbarNav">
					<ul class="navbar-nav me-auto mb-2 mb-lg-0">
						<li class="nav-item">
							<a class="nav-link {{ request()->routeIs('client.home') ? 'active fw-bold text-primary' : '' }}"
								href="{{ route('client.home') }}">
								Trang chủ
							</a>
						</li>
						<li class="nav-item">
							<a class="nav-link {{ request()->routeIs('client.sanpham.list') ? 'active fw-bold text-primary' : '' }}"
							href="{{ route('client.sanpham.list') }}">
							Sản phẩm
							</a>
						</li>
						<li class="nav-item">
							<a class="nav-link {{ request()->routeIs('client.contact.index') ? 'active fw-bold text-primary' : '' }}"
								 href="{{ route('client.contact.index') }}">
								 Liên hệ
							</a>
						</li>
					</ul>

					<ul class="navbar-nav align-items-center">
						<li class="nav-item me-3">
							<a class="nav-link position-relative" href="{{ route('cart.show') }}">
								<i class="bi bi-cart" style="font-size: 1.5rem;"></i>
								@if(session('cart') && count(session('cart')) > 0)
									<span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
										{{ count(session('cart')) }}
									</span>
								@endif
							</a>
						</li>

						@auth
							<li class="nav-item dropdown">
								<a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown">
									<i class="bi bi-person-circle me-1"></i> {{ Auth::user()->name }}
								</a>
								<ul class="dropdown-menu dropdown-menu-end">
									<li>
										<a class="dropdown-item" href="{{ route('profile.edit') }}">Profile</a>
									</li>
									<li>
										<a class="dropdown-item" href="{{ route('client.my-orders') }}">My orders</a>
									</li>
									<li>
										<form method="POST" action="{{ route('logout') }}">
											@csrf
											<button class="dropdown-item">Log Out</button>
										</form>
									</li>
								</ul>
							</li>
						@else
							<li class="nav-item">
								<a class="nav-link" href="{{ route('login') }}">Đăng nhập</a>
							</li>
							<li class="nav-item">
								<a class="nav-link" href="{{ route('register') }}">Đăng ký</a>
							</li>
						@endauth
					</ul>
				</div>
			</div>
		</nav>
	</header>

	<main>
		@yield('content')
	</main>

	<footer class="bg-dark text-white pt-4 pb-3 mt-auto">
		<div class="container">
			<div class="row">
				<div class="col-md-4 mb-3">
					<h5 class="fw-bold">Về chúng tôi</h5>
					<p>Chúng tôi cung cấp sản phẩm chất lượng và dịch vụ tốt nhất cho khách hàng.</p>
				</div>
				<div class="col-md-4 mb-3">
					<h5 class="fw-bold">Liên hệ</h5>
					<ul class="list-unstyled">
						<li>Email: <a href="mailto:contact@yourdomain.com" class="text-white footer-link">contact@yourdomain.com</a></li>
						<li>Điện thoại: <a href="tel:0123456789" class="text-white footer-link">0123 456 789</a></li>
						<li>Địa chỉ: 123 Đường ABC, Thành phố XYZ</li>
					</ul>
				</div>
				<div class="col-md-4 mb-3">
					<h5 class="fw-bold">Mạng xã hội</h5>
					<a href="#" class="text-white me-3 footer-link">
						<i class="bi bi-facebook" style="font-size: 1.5rem;"></i>
					</a>
					<a href="#" class="text-white me-3 footer-link">
						<i class="bi bi-twitter" style="font-size: 1.5rem;"></i>
					</a>
					<a href="#" class="text-white me-3 footer-link">
						<i class="bi bi-instagram" style="font-size: 1.5rem;"></i>
					</a>
				</div>
			</div>
			<hr class="bg-white" />
			<div class="text-center small">
				&copy; 2025 YourCompany. All rights reserved.
			</div>
		</div>
	</footer>

	<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"
		integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous">
	</script>
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js"
		integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+" crossorigin="anonymous">
	</script>
	@stack('script')
</body>

</html>
