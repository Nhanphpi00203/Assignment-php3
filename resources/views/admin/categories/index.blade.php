@extends('admin.layouts.master')

@section('title', 'Danh sách danh mục')

@section('content')
<div class="pt-3 pb-2 mb-4 border-bottom">
    <div class="d-flex justify-content-between align-items-center">
        <h1 class="h3 mb-0 fw-bold text-primary">
            📂 Danh sách danh mục
            <span class="badge bg-secondary">{{ $categories->total() }}</span>
        </h1>
        <a href="{{ route('admin.category.create') }}" class="btn btn-success shadow-sm">
            <i class="bi bi-plus-circle me-1"></i> Thêm danh mục
        </a>
    </div>
</div>

<div class="card shadow-sm border-0 rounded-3">
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table align-middle table-hover mb-0">
                <thead class="table-primary">
                    <tr>
                        <th width="5%">#</th>
                        <th width="20%">Tên</th>
                        <th width="20%">Slug</th>
                        <th width="20%">Trạng thái</th>
                        <th>Mô tả</th>
                        <th width="20%" class="text-center">Hành động</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($categories as $category)
                        <tr>
                            <td>{{ $category->id }}</td>
                            <td class="fw-semibold text-dark">{{ $category->name }}</td>
                            <td class="text-muted">{{ $category->slug }}</td>
                            <td>
    @if($category->status == 1)
        <span class="badge bg-success">
            <i class="bi bi-eye-fill"></i> Hiển thị
        </span>
    @else
        <span class="badge bg-secondary">
            <i class="bi bi-eye-slash-fill"></i> Ẩn
        </span>
    @endif
</td>

                            <td>{{ Str::limit($category->description, 50) }}</td>
                            <td class="text-center">
                                <a href="{{ route('admin.category.edit', $category->id) }}"
                                   class="btn btn-sm btn-outline-warning me-1">
                                   <i class="bi bi-pencil-square"></i> Sửa
                                </a>
                                <form action="{{ route('admin.category.destroy', $category->id) }}"
                                      method="POST" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit"
                                            class="btn btn-sm btn-outline-danger"
                                            onclick="return confirm('Bạn chắc chắn muốn xóa?')">
                                        <i class="bi bi-trash"></i> Xóa
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="text-center text-muted py-4">
                                <i class="bi bi-inbox"></i> Không có danh mục nào.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>

<div class="mt-3">
    {{ $categories->links('pagination::bootstrap-5') }}
</div>
@endsection
