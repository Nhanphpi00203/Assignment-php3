@extends('admin.layouts.master')

@section('title', 'Quản lý Comment')

@section('content')
<div class="container my-4">
    <div class="card shadow-sm animate__animated animate__fadeIn" data-aos="fade-up">
        <div class="card-header bg-white d-flex align-items-center gap-2">
            <i class="bi bi-chat-left-text fs-4 text-primary"></i>
            <h2 class="mb-0">Quản lý Comment</h2>
        </div>
        <div class="card-body">
            @if(session('success'))
                <div class="alert alert-success animate__animated animate__fadeInDown">
                    {{ session('success') }}
                </div>
            @endif

            <div class="table-responsive">
                <table class="table table-striped table-hover align-middle">
                    <thead class="table-light">
                        <tr>
                            <th>ID</th>
                            <th>Content</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($comments as $comment)
                        <tr>
                            <td>{{ $comment->id }}</td>
                            <td>{{ $comment->content }}</td>
                            <td>
                                @if($comment->status)
                                    <span class="badge bg-success"><i class="bi bi-eye-fill"></i>hiện thị</span>
                                @else
                                    <span class="badge bg-secondary"><i class="bi bi-eye-slash-fill"></i>ẩn</span>
                                @endif
                            </td>
                            <td class="d-flex gap-2">
                                <a href="{{ route('admin.comment.edit', $comment->id) }}" class="btn btn-warning btn-sm hvr-grow">
                                    <i class="bi bi-pencil-square me-1"></i> Edit
                                </a>
                                <form action="{{ route('admin.comment.destroy', $comment->id) }}" method="POST" onsubmit="return confirm('Are you sure?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm hvr-shrink">
                                        <i class="bi bi-trash me-1"></i> Delete
                                    </button>
                                </form>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

        </div>
    </div>
</div>
@endsection
