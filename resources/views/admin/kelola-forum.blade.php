@extends('layout.navbar-admin')
@section('judul','Kelola Forum')
@section('judul2','Kelola Forum')
@section('content')
<div class="content">
    <h3>Manajemen Forum Dan Komentar</h3>
    <p>Manajemen data forum post yang terdaftar di sistem.</p>

    <!-- Search and Filter Form -->
    <div class="card mb-4">
        <div class="card-body">
            <form action="{{ route('kelola.forum') }}" method="GET" class="row g-3">
                <div class="col-md-4">
                    <label for="search" class="form-label">Cari</label>
                    <input type="text" class="form-control" id="search" name="search"
                           placeholder="Cari berdasarkan isi post..." value="{{ request('search') }}">
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
                    <label for="date_range" class="form-label">Range Waktu</label>
                    <select class="form-select" name="date_range" id="date_range">
                        <option value="">Semua Waktu</option>
                        <option value="today" {{ request('date_range') == 'today' ? 'selected' : '' }}>Hari Ini</option>
                        <option value="week" {{ request('date_range') == 'week' ? 'selected' : '' }}>Minggu Ini</option>
                        <option value="month" {{ request('date_range') == 'month' ? 'selected' : '' }}>Bulan Ini</option>
                    </select>
                </div>
                <div class="col-md-2">
                    <label class="form-label">&nbsp;</label>
                    <div>
                        <button type="submit" class="btn btn-primary">Filter</button>
                        <a href="{{ route('kelola.forum') }}" class="btn btn-secondary">Reset</a>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <table class="table table-striped table-bordered">
        <thead>
            <tr>
                <th>ID Post</th>
                <th>Isi Post</th>
                <th>Nama Pengguna</th>
                <th>Waktu Dibuat</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach($forumPosts as $post)
                <tr>
                    <td>{{ $post->post_id }}</td>
                    <td>{{ $post->content }}</td>
                    <td>{{ $post->user->name }}</td>
                    <td>{{ $post->created_at }}</td>
                    <td>
                        <form action="{{ route('delete-forum-post', $post->post_id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-danger btn-sm" type="submit">Hapus Postingan</button>
                        </form>
                        <a href="{{ route('view-comments', $post->post_id) }}" class="btn btn-primary btn-sm">Lihat Komentar</a>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <!-- Pagination -->
    <div class="d-flex justify-content-center">
        {{ $forumPosts->appends(request()->query())->links() }}
    </div>
</div>
@endsection
