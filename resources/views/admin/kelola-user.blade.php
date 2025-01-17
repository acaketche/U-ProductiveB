@extends('layout.navbar-admin')
@section('judul','Kelola User')
@section('content')
<div class="content">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h3>Manajemen User</h3>
        <a href="{{route('create-user')}}" class="btn btn-primary">
            <i class="bi bi-plus-lg"></i> Tambah User
        </a>
    </div>

    <div class="card mb-4">
        <div class="card-body">
            <form action="{{ route('kelola.user') }}" method="GET" class="row g-3">
                <div class="col-md-4">
                    <div class="input-group">
                        <input type="text" name="search" class="form-control" placeholder="Cari user..." value="{{ request('search') }}">
                        <button class="btn btn-outline-secondary" type="submit">
                            <i class="bi bi-search"></i>
                        </button>
                    </div>
                </div>
                <div class="col-md-3">
                    <select name="role" class="form-select">
                        <option value="" disabled selected>Pilih Role</option>
                        <option value="admin" {{ request('role') == 'admin' ? 'selected' : '' }}>Admin</option>
                        {{-- <option value="dosen" {{ request('role') == 'dosen' ? 'selected' : '' }}>Dosen</option> --}}
                        <option value="mahasiswa" {{ request('role') == 'mahasiswa' ? 'selected' : '' }}>Mahasiswa</option>
                    </select>
                </div>


                <div class="col-md-3">
                    <button type="submit" class="btn btn-primary me-2">Filter</button>
                    <a href="{{ route('kelola.user') }}" class="btn btn-secondary">Reset</a>
                </div>
                <div class="col-md-2">
                    <button type="submit" name="export" value="pdf" class="btn btn-success w-100">
                        <i class="bi bi-file-pdf"></i> Export PDF
                    </button>
                </div>
            </form>
        </div>
    </div>

    <div class="card">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-striped table-bordered">
                    <thead>
                        <tr>
                            <th>Nomor</th>
                            <th>Nama User</th>
                            <th>Email</th>
                            <th>Role</th>
                            {{-- <th>NIM/NIDN</th> --}}
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($users as $user)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $user->name }}</td>
                                <td>{{ $user->email }}</td>
                                <td>{{ $user->role }}</td>
                                {{-- <td>{{ $user->identifier }}</td> --}}
                                <td>
                                    <form action="{{ route('delete-user', $user->user_id) }}" method="POST" class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button class="btn btn-danger btn-sm" type="submit" onclick="return confirm('Apakah Anda yakin ingin menghapus user ini?')">
                                            <i class="bi bi-trash"></i> Hapus
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <div class="d-flex justify-content-center mt-4">
                {{ $users->links('pagination::bootstrap-4') }}
            </div>
        </div>
    </div>
</div>

<style>
.pagination {
    margin: 0;
}
.pagination .page-link {
    padding: 0.5rem 0.75rem;
    margin: 0 2px;
    border-radius: 4px;
}
.card {
    box-shadow: 0 0 10px rgba(0,0,0,.1);
}
.table th {
    background-color: #f8f9fa;
}
</style>
@endsection
