@extends('layout.navbar-admin')
@section('judul','Kelola Komentar')
@section('judul2','Kelola Komentar')
@section('content')
<div class="content">
    <p>Manajemen data komentar terkait post ID: {{ $post->post_id }}</p>
    <!-- Search and Filter Form -->
    <div class="card mb-4">
        <div class="card-body">
            <form action="{{ route('view-comments', $post->post_id) }}" method="GET" class="row g-3">
                <div class="col-md-4">
                    <label for="search" class="form-label">Cari Komentar</label>
                    <input type="text" class="form-control" id="search" name="search"
                           placeholder="Cari berdasarkan isi komentar..." value="{{ request('search') }}">
                </div>
                <div class="col-md-3">
                    <label for="user" class="form-label">Filter Pengguna</label>
                    <select class="form-select" name="user" id="user">
                        <option value="">Semua Pengguna</option>
                        @foreach($users as $user)
                            <option value="{{ $user->user_id }}" {{ request('user') == $user->user_id ? 'selected' : '' }}>
                                {{ $user->name }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-3">
                    <label class="form-label">&nbsp;</label>
                    <div>
                        <button type="submit" class="btn btn-primary">Filter</button>
                        <a href="{{ route('view-comments', $post->post_id) }}" class="btn btn-secondary">Reset</a>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <table class="table table-striped table-bordered">
        <thead>
            <tr>
                <th>ID Komentar</th>
                <th>Isi Komentar</th>
                <th>Nama Pengguna</th>
                <th>Waktu Dibuat</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach($comments as $comment)
                <tr>
                    <td>{{ $comment->comment_id }}</td>
                    <td>{{ $comment->content }}</td>
                    <td>{{ $comment->user->name }}</td>
                    <td>{{ $comment->created_at }}</td>
                    <td>
                        <form action="{{ route('delete-comment', $comment->comment_id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-danger btn-sm" type="submit">Hapus Komentar</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <!-- Pagination with improved styling -->
    <div class="row mt-4">
        <div class="col-12">
            <nav aria-label="Page navigation">
                <div class="d-flex justify-content-center">
                    {{ $comments->appends(request()->query())->links('pagination::bootstrap-4', ['class' => 'pagination justify-content-center']) }}
                </div>
            </nav>
        </div>
    </div>
</div>

<!-- Add this CSS to your page or stylesheet -->
<style>
.pagination {
    margin: 0;
    padding: 0;
}

.page-item.active .page-link {
    background-color: #007bff;
    border-color: #007bff;
}

.page-link {
    padding: 0.5rem 0.75rem;
    margin-left: -1px;
    line-height: 1.25;
    color: #007bff;
    background-color: #fff;
    border: 1px solid #dee2e6;
}

.page-link:hover {
    color: #0056b3;
    text-decoration: none;
    background-color: #e9ecef;
    border-color: #dee2e6;
}

.page-item.disabled .page-link {
    color: #6c757d;
    pointer-events: none;
    background-color: #fff;
    border-color: #dee2e6;
}
</style>
@endsection
