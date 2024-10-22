@extends('layout.navbar-admin')
@section('judul','Kelola Komentar')
@section('judul2','Kelola Komentar')
@section('content')

<div class="content">
    <p>Manajemen data komentar terkait post ID: {{ $post->post_id }}</p>

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
</div>

@endsection
