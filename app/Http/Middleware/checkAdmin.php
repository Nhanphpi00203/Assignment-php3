<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class checkAdmin
{
	/**
	 * Handle an incoming request.
	 */
	public function handle(Request $request, Closure $next): Response
	{
		$user = Auth::user();

		// Nếu chưa đăng nhập hoặc không phải admin thì chặn
		if (!$user || $user->role !== 'admin') {
			return redirect()->route('client.home')->with('error', 'Bạn không có quyền truy cập trang này.');
		}

		return $next($request);
	}
}
