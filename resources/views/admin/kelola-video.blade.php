@extends('layout.navbar-admin')
@section('judul','Kelola Video')
@section('judul2','Kelola Video')
@section('content')

<div class="content">
    <h3>Manajemen Video</h3>

    <!-- Search and Filter Form -->
    <div class="card mb-4">
        <div class="card-body">
            <form action="{{ route('kelola.video') }}" method="GET" class="row g-3">
                <!-- Search -->
                <div class="col-md-4">
                    <input type="text"
                           name="search"
                           class="form-control"
                           placeholder="Cari berdasarkan judul, ID Video, atau ID user"
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
                    <a href="{{ route('kelola.video') }}" class="btn btn-secondary">
                        <i class="fas fa-sync"></i> Reset
                    </a>
                    <button type="submit" name="export" value="1" class="btn btn-success float-end">
                        <i class="fas fa-file-pdf"></i> Export PDF
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
                    <th>Judul</th>
                    <th>URL</th>
                    <th>Kategori</th>
                    <th>ID User</th>
                    <th>Dibuat Pada</th>
                    <th>Status</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach($videos as $video)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $video->title }}</td>
                        <td>{{ $video->url}}</td>
                        <td>{{ $video->category->name }}</td>
                        <td>{{ $video->user_id }}</td>
                        <td>{{ $video->created_at }}</td>
                        <td>
                            <span class="badge {{ $video->status == 'approved' ? 'bg-success' : ($video->status == 'rejected' ? 'bg-danger' : 'bg-warning') }}">
                                {{ ucfirst($video->status) }}
                            </span>
                        </td>
                        <td>
                            @if($video->status == 'approved')
                                @if($video->is_active)
                                    <form action="{{ route('admin.stop-video', $video->video_id) }}" method="POST" style="display:inline;">
                                        @csrf
                                        <button type="submit" class="btn btn-sm btn-warning">Tidak Tayang</button>
                                    </form>
                                @else
                                    <form action="{{ route('admin.start-video', $video->video_id) }}" method="POST" style="display:inline;">
                                        @csrf
                                        <button type="submit" class="btn btn-sm btn-success">Tayang</button>
                                    </form>
                                @endif
                            @else
                                @if($video->status != 'approved')
                                    <form action="{{ route('admin.approve-video', $video->video_id) }}" method="POST" style="display:inline;">
                                        @csrf
                                        <button type="submit" class="btn btn-sm btn-success">Setujui</button>
                                    </form>
                                @endif

                                @if($video->status != 'rejected')
                                    <form action="{{ route('admin.reject-video', $video->video_id) }}" method="POST" style="display:inline;">
                                        @csrf
                                        <button type="submit" class="btn btn-sm btn-danger">Tolak</button>
                                    </form>
                                @endif
                            @endif
                            <a href="{{ route('video.kelola.show', $video->video_id) }}" class="btn btn-info btn-sm">
                                <i class="fas fa-eye"></i> Lihat Video
                            </a>

                            <form action="{{ route('delete-video', $video->video_id) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-danger btn-sm" type="submit"
                                        onclick="return confirm('Apakah Anda yakin ingin menghapus video ini?')">
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
        {{ $videos->links('pagination::bootstrap-4') }}
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
            if (this.action.includes('delete-video')) {
                if (!confirm('Apakah Anda yakin ingin menghapus video ini?')) {
                    e.preventDefault();
                }
            }
        });
    });
</script>
@endpush
