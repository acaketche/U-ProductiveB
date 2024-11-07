@extends('layout.navbar-admin')
@section('judul','Tugas Akhir IF')
@section('judul2','Tugas Akhir IF')
@section('content')
<div class="content">
    <h3>Manajemen Tugas AKhir Informatika</h3>
    <p>Manajemen Tugas Akhir Prodi Informatika STT Payakumbuh</p>

    <!-- Search and Filter Form -->
    <div class="card mb-4">
        <div class="card-body">
            <form action="{{ route('kelola.informatika') }}" method="GET" class="row g-3">
                <!-- Search -->
                <div class="col-md-4">
                    <input type="text"
                           name="search"
                           class="form-control"
                           placeholder="Cari Tugas Akhir"
                           value="{{ request('search') }}">
                </div>

                <!-- Date Range -->
                <div class="col-md-3">
                    <input type="date"
                           name="start_date"
                           class="form-control"
                           placeholder="Tanggal Mulai"
                           value="{{ request('start_date') }}">
                </div>
                <div class="col-md-3">
                    <input type="date"
                           name="end_date"
                           class="form-control"
                           placeholder="Tanggal Akhir"
                           value="{{ request('end_date') }}">
                </div>


                <!-- Buttons -->
                <div class="col-12">
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-search"></i> Cari
                    </button>
                    <a href="{{ route('kelola.informatika') }}" class="btn btn-secondary">
                        <i class="fas fa-sync"></i> Reset
                    </a>
                    <button type="submit" name="export" value="1" class="btn btn-success float-end">
                        <i class="fas fa-file-pdf"></i> Export PDF
                    </button>
                </div>
            </form>
        </div>
    </div>

    <!-- Table -->
    <div class="card">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-striped table-bordered">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Judul</th>
                            <th>File Pdf</th>
                            <th>Kategori</th>
                            <th>User</th>
                            <th>Created At</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($informatics as $informatic)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $informatic->title }}</td>
                                <td>{{ $informatic->file_pdf }}</td>
                                <td>{{ $informatic->category->name }}</td>
                                <td>{{ optional($informatic->user)->name ?? 'Unknown User' }}</td>
                                <td>{{ $informatic->create_at ?? 'No Date Available' }}</td>
                                <td>
                                    <form action="{{ route('delete-if', $informatic->if_id) }}" method="POST" style="display:inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button class="btn btn-danger btn-sm" type="submit"
                                                onclick="return confirm('Apakah Anda yakin ingin menghapus tugas akhir ini?')">
                                            Hapus
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <!-- Updated Pagination -->
            <div class="d-flex justify-content-center mt-4">
                {{ $informatics->links('pagination::bootstrap-4') }}
            </div>
        </div>
    </div>
</div>
@endsection

@push('styles')
<style>
    .table th {
        background-color: #f8f9fa;
    }
    .badge {
        font-size: 0.875rem;
    }
    .action-buttons {
        white-space: nowrap;
    }
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
</style>
@endpush
