@extends('layout.navbar-admin')
@section('judul','Kelola Video')
@section('judul2','Kelola Video')
@section('content')

<div class="content">
    <p>Manajemen data kategori yang terdaftar di sistem untuk bagian filter dan tambah artikel dan video.</p>

    <div class="table-responsive">
        <table class="table table-striped table-bordered">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Judul</th>
                    <th>URL</th>
                    <th>Kategori</th>
                    <th>ID User</th>
                    <th>Created At</th>
                    <th>Status</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach($videos as $video)
                    <tr>
                        <td>{{ $video->video_id }}</td>
                        <td>{{ $video->title }}</td>
                        <td>{{ $video->url}}</td>
                        <td>{{ $video->category->name }}</td>
                        <td>{{ $video->user_id }}</td>
                        <td>{{ $video->created_at }}</td>
                        <td>
                            <span class="badge {{ $video->status == 'approved' ? 'bg-success' : 'bg-danger' }}">
                                {{ ucfirst($video->status) }}
                            </span>
                        </td>
                        <td>
                            @if($video->status == 'rejected')
                            <form action="{{ route('admin.approve-video', $video->video_id) }}" method="POST" style="display:inline;">
                                @csrf
                                <button type="submit" class="btn btn-sm btn-success">Setujui</button>
                            </form>

                            <form action="{{ route('admin.reject-video', $video->video_id) }}" method="POST" style="display:inline;">
                                @csrf
                                <button type="submit" class="btn btn-sm btn-danger">Tolak</button>
                            </form>
                            @endif

                            <form action="{{ route('delete-video', $video->video_id) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-danger btn-sm" type="submit">Hapus</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

@endsection
