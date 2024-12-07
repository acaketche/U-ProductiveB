@extends('layout.navbar-admin')
@section('judul','Kelola Artikel')
@section('judul2','Kelola Artikel')
@section('content')
<div class="content">
    <h3>Manajemen Artikel</h3>

    <!-- Search and Filter Form -->
    <div class="card mb-4">
        <div class="card-body">
            <form action="{{ route('kelola.artikel') }}" method="GET" class="row g-3">
                <!-- Search -->
                <div class="col-md-4">
                    <input type="text"
                           name="search"
                           class="form-control"
                           placeholder="Cari berdasarkan judul, ID artikel, atau ID user"
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

                <!-- Status Filter -->
                <div class="col-md-2">
                    <select name="status" class="form-select">
                        <option value=""disabled selected>Semua Status</option>
                        <option value="approved" {{ request('status') == 'approved' ? 'selected' : '' }}>Approved</option>
                        <option value="rejected" {{ request('status') == 'rejected' ? 'selected' : '' }}>Rejected</option>
                        <option value="pending" {{ request('status') == 'pending' ? 'selected' : '' }}>Pending</option>
                    </select>
                </div>

                <!-- Buttons -->
                <div class="col-12">
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-search"></i> Cari
                    </button>
                    <a href="{{ route('kelola.artikel') }}" class="btn btn-secondary">
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
                            <th>Nomor</th>
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
                                <td>{{ $loop->iteration}}</td>
                                <td>{{ $article->title }}</td>
                                <td>{{ $article->category->name }}</td>
                                <td>{{ $article->user_id }}</td>
                                <td>{{ $article->created_at }}</td>
                                <td>
                                    <span class="badge {{ $article->status == 'approved' ? 'bg-success' : ($article->status == 'rejected' ? 'bg-danger' : 'bg-warning') }}">
                                        {{ ucfirst($article->status) }}
                                    </span>
                                </td>
                                    <td>
                                        @if($article->status == 'approved')
                                            @if($article->is_active)
                                                <form action="{{ route('admin.stop-article', $article->article_id) }}" method="POST" style="display:inline;">
                                                    @csrf
                                                    <button type="submit" class="btn btn-sm btn-warning">Stop</button>
                                                </form>
                                            @else
                                                <form action="{{ route('admin.start-article', $article->article_id) }}" method="POST" style="display:inline;">
                                                    @csrf
                                                    <button type="submit" class="btn btn-sm btn-success">Start</button>
                                                </form>
                                            @endif
                                        @else
                                            @if($article->status != 'approved')
                                                <form action="{{ route('admin.approve-article', $article->article_id) }}" method="POST" style="display:inline;">
                                                    @csrf
                                                    <button type="submit" class="btn btn-sm btn-success">Setujui</button>
                                                </form>
                                            @endif

                                            @if($article->status != 'rejected')
                                                <form action="{{ route('admin.reject-article', $article->article_id) }}" method="POST" style="display:inline;">
                                                    @csrf
                                                    <button type="submit" class="btn btn-sm btn-danger">Tolak</button>
                                                </form>
                                            @endif
                                        @endif
                                        <a href="{{ route('articles.kelola.show', $article->article_id) }}" class="btn btn-info btn-sm">
                                            <i class="fas fa-eye"></i> Lihat Artikel
                                        </a>
                                        <form action="{{ route('delete-artikel', $article->article_id) }}" method="POST" style="display:inline;">
                                            @csrf
                                            @method('DELETE')
                                            <button class="btn btn-danger btn-sm" type="submit"
                                                    onclick="return confirm('Apakah Anda yakin ingin menghapus artikel ini?')">
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
                {{ $articles->links('pagination::bootstrap-4') }}
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

@push('scripts')
<script>
    // Konfirmasi sebelum menghapus
    document.querySelectorAll('form').forEach(form => {
        form.addEventListener('submit', function(e) {
            if (this.action.includes('delete-artikel')) {
                if (!confirm('Apakah Anda yakin ingin menghapus artikel ini?')) {
                    e.preventDefault();
                }
            }
        });
    });
</script>
@endpush
