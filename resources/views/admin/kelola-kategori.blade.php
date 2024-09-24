@extends('layout.navbar-admin')
@section('judul','Kelola Kategori')
@section('judul2','Kelola Kategori')
@section('content')
                <div class="content">
                    <p>Manajemen data kategori yang terdaftar di sistem untuk bagian filter dan tambah artikel dan video.</p>

                    <!-- Tombol Tambah -->
                    <a href="{{ route('tambah-kategori') }}" class="btn btn-primary mb-3">Tambah Kategori</a>

                    <table class="table table-striped table-bordered">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Kategori</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($categories as $category)
                                <tr>
                                    <td>{{ $category->category_id }}</td>
                                    <td>{{ $category->name }}</td>
                                    <td>
                                        {{-- <a href="{{ route('edit-kategori', $category->category_id) }}" class="btn btn-warning btn-sm">Edit</a> --}}
                                        <form action="{{ route('delete-kategori', $category->category_id) }}" method="POST" style="display:inline;">
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
