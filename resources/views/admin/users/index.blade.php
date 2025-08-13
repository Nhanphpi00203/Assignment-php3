@extends('admin.layouts.master')

@section('title', 'Danh sách người dùng')

@section('content')
    <div class="pt-3 pb-2 mb-4 border-bottom">
        <div class="d-flex justify-content-between align-items-center">
            <h1 class="h3 mb-0 fw-bold text-primary">
                👤 Danh sách người dùng
                <span class="badge bg-secondary">{{ $users->total() }}</span>
            </h1>
            <a href="{{ route('admin.user.create') }}" class="btn btn-success shadow-sm">
                <i class="bi bi-plus-circle me-1"></i> Thêm người dùng
            </a>
        </div>
    </div>

    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <div class="table-responsive shadow-sm rounded bg-white p-3">
        <table class="table table-hover align-middle">
            <thead class="table-dark">
                <tr>
                    <th scope="col">#ID</th>
                    <th scope="col">Tên</th>
                    <th scope="col">Email</th>
                    <th scope="col">Quyền</th>
                    <th scope="col" class="text-center">Hành động</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($users as $user)
                    <tr>
                        <td><strong>{{ $user->id }}</strong></td>
                        <td>{{ $user->name }}</td>
                        <td>{{ $user->email }}</td>
                        <td>
                            @if ($user->role == 'admin')
                                <span class="badge bg-primary">Admin</span>
                            @else
                                <span class="badge bg-info text-dark">User</span>
                            @endif
                        </td>
                        <td class="text-center">
                            <a href="{{ route('admin.user.edit', $user->id) }}" class="btn btn-sm btn-warning">
                                ✏ Sửa
                            </a>
                            <form action="{{ route('admin.user.destroy', $user->id) }}" method="POST" class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Bạn chắc chắn muốn xóa?')">
                                    🗑 Xóa
                                </button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="text-center text-muted">Không có người dùng nào.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="mt-3">
        {{ $users->links() }}
    </div>
@endsection
