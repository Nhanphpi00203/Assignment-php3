<!-- resources/views/admin/components/aside.blade.php -->
<nav id="sidebarMenu"
     class="col-md-3 col-lg-2 d-md-block sidebar collapse animate__animated animate__fadeInLeft"
     style="background: #f1f5f9; min-height: 100vh; border-right: 1px solid #e5e7eb;"
     data-aos="fade-right">
    <div class="position-sticky pt-3">
        <ul class="nav flex-column">
            <li class="nav-item mb-1">
                <a class="nav-link hvr-underline-from-left {{ Route::currentRouteName() == 'admin.dashboard' ? 'active' : '' }}"
                   style="color:#374151; {{ Route::currentRouteName() == 'admin.dashboard' ? 'background:#e0e7ff; border-radius:6px;' : '' }}"
                   href="{{ route('admin.dashboard') }}">
                    <i class="bi bi-speedometer2"></i> Dashboard
                </a>
            </li>
            <li class="nav-item mb-1">
                <a class="nav-link hvr-underline-from-left {{ Route::currentRouteName() == 'admin.product.list' ? 'active' : '' }}"
                   style="color:#374151; {{ Route::currentRouteName() == 'admin.product.list' ? 'background:#e0e7ff; border-radius:6px;' : '' }}"
                   href="{{ route('admin.product.list') }}">
                    <i class="bi bi-box-seam"></i> Quản lý sản phẩm
                </a>
            </li>
            <li class="nav-item mb-1">
                <a class="nav-link hvr-underline-from-left {{ Route::currentRouteName() == 'admin.category.list' ? 'active' : '' }}"
                   style="color:#374151; {{ Route::currentRouteName() == 'admin.category.list' ? 'background:#e0e7ff; border-radius:6px;' : '' }}"
                   href="{{ route('admin.category.list') }}">
                    <i class="bi bi-tags"></i> Quản lý danh mục
                </a>
            </li>
            <li class="nav-item mb-1">
                <a class="nav-link hvr-underline-from-left {{ Route::currentRouteName() == 'admin.order.list' ? 'active' : '' }}"
                   style="color:#374151; {{ Route::currentRouteName() == 'admin.order.list' ? 'background:#e0e7ff; border-radius:6px;' : '' }}"
                   href="{{ route('admin.order.list') }}">
                    <i class="bi bi-cart-check"></i> Quản lý đơn hàng
                </a>
            </li>
          <li class="nav-item mb-1">
                <a class="nav-link hvr-underline-from-left {{ Str::startsWith(Route::currentRouteName(), 'admin.comment') ? 'active' : '' }}"
                   style="color:#374151; {{ Str::startsWith(Route::currentRouteName(), 'admin.comment') ? 'background:#e0e7ff; border-radius:6px;' : '' }}"
                   href="{{ route('admin.comment.list') }}">
                    <i class="bi bi-chat-left-text"></i> Quản lý comment
                </a>
            </li>
           <li class="nav-item mb-1">
    					<a class="nav-link hvr-underline-from-left {{ Str::startsWith(Route::currentRouteName(), 'admin.user') ? 'active' : '' }}"
   style="color:#374151; {{ Str::startsWith(Route::currentRouteName(), 'admin.user') ? 'background:#e0e7ff; border-radius:6px;' : '' }}"
   href="{{ route('admin.user.list') }}">
    <i class="bi bi-people"></i> Quản lý người dùng
</a>
						</li>


        </ul>
    </div>
</nav>
