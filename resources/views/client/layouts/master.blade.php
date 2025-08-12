<!doctype html>
<html lang="en">

<head>
    <title>
        @yield('meta_title')
    </title>
    <!-- Required meta tags -->
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <!-- Bootstrap CSS v5.2.1 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous" />

    @stack('style')
</head>
<body>
    <header>
    <nav class="navbar navbar-expand-lg navbar-light bg-light border-bottom">
        <div class="container">
            <a class="navbar-brand" href="{{ route('dashboard') }}">
                <img src="{{ asset('assets/images/logo-3.png') }}" alt="Logo" height="30">
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav me-auto">
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('client.home') ? 'active' : '' }}"
   												href="{{ route('client.home') }}">
  												Trang chủ
												</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('client.contact.index') ? 'active' : '' }}"
                           href="{{ route('client.contact.index') }}">
                           Liên hệ
                        </a>
                    </li>
                </ul>

                <ul class="navbar-nav">
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown">
                            {{ Auth::user()->name }}
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end">
                            <li>
                                <a class="dropdown-item" href="{{ route('profile.edit') }}">Profile</a>
                            </li>
                            <li>
                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf
                                    <button class="dropdown-item">Log Out</button>
                                </form>
                            </li>
                        </ul>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
</header>

    <main>
        @yield('content')
    </main>



    <footer class="bg-dark text-white pt-4 pb-3">
  <div class="container">
    <div class="row">
      <!-- About -->
      <div class="col-md-4 mb-3">
        <h5>Về chúng tôi</h5>
        <p>Chúng tôi cung cấp sản phẩm chất lượng và dịch vụ tốt nhất cho khách hàng.</p>
      </div>
      <!-- Contact -->
      <div class="col-md-4 mb-3">
        <h5>Liên hệ</h5>
        <ul class="list-unstyled">
          <li>Email: contact@yourdomain.com</li>
          <li>Điện thoại: 0123 456 789</li>
          <li>Địa chỉ: 123 Đường ABC, Thành phố XYZ</li>
        </ul>
      </div>
      <!-- Social media -->
      <div class="col-md-4 mb-3">
        <h5>Mạng xã hội</h5>
        <a href="#" class="text-white me-3">
          <i class="bi bi-facebook" style="font-size: 1.5rem;"></i>
        </a>
        <a href="#" class="text-white me-3">
          <i class="bi bi-twitter" style="font-size: 1.5rem;"></i>
        </a>
        <a href="#" class="text-white me-3">
          <i class="bi bi-instagram" style="font-size: 1.5rem;"></i>
        </a>
      </div>
    </div>
    <hr class="bg-white" />
    <div class="text-center">
      &copy; 2025 YourCompany. All rights reserved.
    </div>
  </div>
</footer>

    <!-- Bootstrap JavaScript Libraries -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"
        integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous">
        </script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js"
        integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+" crossorigin="anonymous">
        </script>

    @stack('script')
</body>

</html>
