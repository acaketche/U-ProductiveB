@extends('layout.navbar-admin')
@section('judul','Kelola Artikel')
@section('judul2','Kelola Artikel')
@section('content')
                <div class="content">
                    <p>Manajemen data kategori yang terdaftar di sistem untuk bagian filter dan tambah artikel dan video.</p>

                    <table class="table table-striped table-bordered">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Judul</th>
                                <th>Kategori</th>
                                <th>ID User</th>
                                <th>Created At</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($articles as $article)
                                <tr>
                                    <td>{{ $article->article_id }}</td>
                                    <td>{{ $article->title }}</td>
                                    <td>{{ $article->category->name }}</td>
                                    <td>{{ $article->user_id }}</td>
                                    <td>{{ $article->created_at }}</td>
                                    <td>
                                        <span class="badge {{ $article->status == 'approved' ? 'bg-success' : 'bg-danger' }}">
                                            {{ ucfirst($article->status) }}
                                        </span>
                                    </td>
                                    <td>
                                        @if($article->status != 'rejected')
                                        <form action="{{ route('admin.approve-article', $article->article_id) }}" method="POST" style="display:inline;">
                                            @csrf
                                            <button type="submit" class="btn btn-sm btn-success">Setujui</button>
                                        </form>
                                        <form action="{{ route('admin.reject-article', $article->article_id) }}" method="POST" style="display:inline;">
                                            @csrf
                                            <button type="submit" class="btn btn-sm btn-danger">Tolak</button>
                                        </form>
                                    @endif


                                        <form action="{{ route('delete-artikel', $article->article_id) }}" method="POST" style="display:inline;">
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
            </main>
    </div>
  @endsection
