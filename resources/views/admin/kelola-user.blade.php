@extends('layout.navbar-admin')
@section('judul','Kelola User')
@section('judul2','Kelola User')
@section('content')

                <div class="content">
                    <p>Manajemen data kategori yang terdaftar di sistem untuk bagian filter dan tambah artikel dan video.</p>
                    <table class="table table-striped table-bordered">
                        <thead>
                            <tr>
                                <th>User_ID</th>
                                <th>Nama User</th>
                                <th>Email</th>
                                <th>Role</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($users as $user)
                                <tr>
                                    <td>{{ $user->user_id }}</td>
                                    <td>{{ $user->name }}</td>
                                    <td>{{ $user->email }}</td>
                                    <td>{{ $user->role }}</td>
                                    <td>
                                        {{-- <a href="{{ route('edit-kategori', $category->category_id) }}" class="btn btn-warning btn-sm">Edit</a> --}}
                                        <form action="{{ route('delete-user', $user->user_id) }}" method="POST" style="display:inline;">
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
