@extends('layout.navbar-admin')
@section('judul', 'Kelola Kategori')
@section('content')
<div class="content">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h3>Manajemen Kategori</h3>
        <a href="{{ route('tambah-kategori') }}" class="btn btn-primary">
            <i class="bi bi-plus-lg"></i> Tambah Kategori
        </a>
    </div>

    <div class="card mb-4">
        <div class="card-body">
            <form action="{{ route('kelola.kategori') }}" method="GET" class="row g-3">
                <div class="col-md-4">
                    <div class="input-group">
                        <input type="text" name="search" class="form-control" placeholder="Cari kategori..." value="{{ request('search') }}">
                        <button class="btn btn-outline-secondary" type="submit">
                            <i class="bi bi-search"></i>
                        </button>
                    </div>
                </div>
                <div class="col-md-3">
                    <select name="prodi" class="form-select">
                        <option value="">Semua Prodi</option>
                        @foreach($prodis as $prodi)
                            <option value="{{ $prodi->prodi_id }}" {{ request('prodi') == $prodi->prodi_id ? 'selected' : '' }}>
                                {{ $prodi->name }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-3">
                    <button type="submit" class="btn btn-primary me-2">Filter</button>
                    <a href="{{ route('kelola.kategori') }}" class="btn btn-secondary">Reset</a>
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
                            <th>Kategori ID</th>
                            <th>Nama Kategori</th>
                            <th>Nama Prodi</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($categories as $category)
                            <tr>
                                <td>{{ $category->category_id }}</td>
                                <td>{{ $category->name }}</td>
                                <td>{{ optional($category->prodi)->name }}</td>
                                <td>
                                    <form action="{{ route('delete-kategori', $category->category_id) }}" method="POST" class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button class="btn btn-danger btn-sm" type="submit" onclick="return confirm('Apakah Anda yakin ingin menghapus kategori ini?')">
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
                {{ $categories->links('pagination::bootstrap-4') }}
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
