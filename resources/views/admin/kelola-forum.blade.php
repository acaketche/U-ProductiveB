@extends('layout.navbar-admin')
@section('judul','Kelola Forum')
@section('judul2','Kelola Forum')
@section('content')

<div class="content">
    <p>Manajemen data forum post yang terdaftar di sistem.</p>

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
                        <a href="{{ route('view-comments', $post->post_id) }}" class="btn btn-primary btn-sm">Lihat Komentar</a> <!-- Ensure the post ID is passed here -->
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>

@endsection
