@extends('layout.navbar-video')

@section('content')
<div class="container mt-4">
    <div class="d-flex justify-content-center align-items-center mb-4">
        <button class="btn btn-primary me-2" onclick="window.location.href='{{ route('video.create') }}';">
            <i class="bi bi-plus-lg me-2"></i>Tambah
        </button>
        <div class="d-flex">
            <form action="{{ route('video.index') }}" method="GET" class="d-flex">
                <input type="text" name="cari" class="form-control me-2" placeholder="Cari Video" value="{{ request('cari') }}">
                <!-- Filter Dropdown Form -->
                    <form action="{{ route('video.index') }}" method="GET" class="dropdown-center">
                        <button class="btn btn-outline-primary dropdown-toggle" type="button" id="filterDropdown" data-bs-toggle="dropdown" aria-expanded="false">
                            Filter
                        </button>
                        <div class="dropdown-menu p-3" style="width: 600px;">
                            <div class="row g-3">
                                <div class="col-6">
                                    <label for="kategori" class="form-label">Kategori</label>
                                    <select class="form-select" id="kategori" name="category">
                                        <option value ="">Pilih</option>
                                        @foreach ($categories as $category)
                                        <option value="{{ $category->category_id }}" {{ request('category') == $category->category_id ? 'selected' : '' }}>
                                            {{ $category->name }}
                                        </option>
                                    @endforeach
                                    </select>
                                </div>
                                <div class="col-6">
                                    <label for="waktu" class="form-label">Waktu</label>
                                    <select class="form-select" id="waktu" name="time">
                                        <option value="" {{ request('time') == '' ? 'selected' : '' }}>Semua Waktu</option>
                                        <option value="24 Jam" {{ request('time') == '24 Jam' ? 'selected' : '' }}>Dalam 24 Jam</option>
                                        <option value="1 Minggu" {{ request('time') == '1 Minggu' ? 'selected' : '' }}>1 Minggu Terakhir</option>
                                        <option value="1 Bulan" {{ request('time') == '1 Bulan' ? 'selected' : '' }}>1 Bulan Terakhir</option>
                                    </select>
                                </div>
                            </div>
                            <div class="d-flex justify-content-between mt-3">
                                <!-- Clear filters button -->
                                <a href="{{ route('video.index') }}" class="btn btn-link text-danger p-0">Bersihkan filter</a>
                                <div>
                                    <button type="button" class="btn btn-outline-secondary btn-sm me-2" data-bs-dismiss="dropdown">Batal</button>
                                    <!-- Apply filters button -->
                                    <button type="submit" class="btn btn-primary btn-sm">Terapkan</button>
                                </div>
                            </div>
                        </div>
                    </form>
            </form>
        </div>
    </div>

    @if(isset($videos) && $videos->count() > 0)
    <div class="row">
        @foreach($videos as $video)
        <div class="col-md-3 mb-4">
            <div class="card h-100">
                <a href="{{ route('video.show', $video->video_id) }}" class="video-thumbnail">
                    <img src="{{ $video->thumbnail_url }}" class="card-img-top" alt="{{ $video->title }}">
                    <div class="play-icon">
                        <i class="bi bi-play-circle"></i>
                    </div>
                </a>
                <div class="card-body">
                    <h5 class="card-title">{{ $video->title }}</h5>
                    <p class="card-text">Kategori: {{ $video->category->name }}</p>
                    {{-- <a href="https://www.youtube.com/watch?v={{ $video->youtube_id }}" class="btn btn-primary btn-sm" target="_blank">Tonton di YouTube</a> --}}
                </div>
            </div>

            <!-- Modal -->
            <div class="modal fade" id="videoModal{{ $video->id }}" tabindex="-1" aria-labelledby="videoModalLabel{{ $video->id }}" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="videoModalLabel{{ $video->id }}">{{ $video->title }}</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="ratio ratio-16x9">
                        <iframe id="videoFrame{{ $video->video_id }}" src="https://www.youtube.com/embed/{{ $video->youtube_id }}?autoplay=1" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                    </div>
                </div>
                <div class="modal-footer">
                    <a href="{{ route('video.show', $video->video_id) }}" class="btn btn-primary">Lihat Detail</a>
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                </div>
            </div>
        </div>
    </div>
        </div>
        @endforeach
    </div>
    @else
    <p>Tidak ada video ditemukan.</p>
    @endif
</div>

<script>
    // Bersihkan iframe ketika modal ditutup
    document.querySelectorAll('.modal').forEach(modal => {
        modal.addEventListener('hidden.bs.modal', function () {
            const iframe = this.querySelector('iframe');
            iframe.src = iframe.src; // Refresh iframe source
        });
    });
</script>
@endsection
