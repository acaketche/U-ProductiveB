@extends('layout.navbar-guest')

@section('content')
<div class="container mt-4">
    <div class="row justify-content-center mb-4">
        <div class="col-md-10">
            <div class="d-flex justify-content-center align-items-center flex-wrap">
                <form action="{{ route('video.index') }}" method="GET" class="d-flex flex-grow-1 flex-wrap justify-content-center align-items-center">
                    <button class="btn btn-primary me-2 mb-2 mb-md-0" type="button" onclick="window.location.href='{{ route('tambah-video') }}';">
                        <i class="bi bi-plus-lg me-1"></i>Tambah
                    </button>
                    <div class="input-group me-2 mb-2 mb-md-0 flex-grow-1" style="max-width: 300px;">
                        <input type="text" name="cari" class="form-control" placeholder="Cari Video" value="{{ request('cari') }}">
                        <button class="btn btn-outline-secondary" type="submit">
                            <i class="bi bi-search"></i>
                        </button>
                    </div>
                    <div class="dropdown mb-2 mb-md-0">
                        <button class="btn btn-outline-primary dropdown-toggle" type="button" id="filterDropdown" data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="bi bi-funnel me-1"></i>Filter
                        </button>
                        <div class="dropdown-menu p-3" style="width: 350px; padding: 15px; box-shadow: 0 0.5rem 1rem rgba(0, 0, 0, 0.15); border: none; border-radius: 10px;">
                            <div class="row g-3">
                                <div class="col-md-6">
                                    <label for="kategori" class="form-label" style="font-weight: bold; font-size: 1rem;">Kategori</label>
                                    <select class="form-select" id="kategori" name="category" style="font-size: 1rem; padding: 0.75rem;">
                                        <option value="">Pilih</option>
                                        @foreach ($categories as $category)
                                            <option value="{{ $category->category_id }}" {{ request('category') == $category->category_id ? 'selected' : '' }}>
                                                {{ $category->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-md-6">
                                    <label for="waktu" class="form-label" style="font-weight: bold; font-size: 1rem;">Waktu</label>
                                    <select class="form-select" id="waktu" name="time" style="font-size: 1rem; padding: 0.75rem;">
                                        <option value="" {{ request('time') == '' ? 'selected' : '' }}>Semua Waktu</option>
                                        <option value="24 Jam" {{ request('time') == '24 Jam' ? 'selected' : '' }}>Dalam 24 Jam</option>
                                        <option value="1 Minggu" {{ request('time') == '1 Minggu' ? 'selected' : '' }}>1 Minggu Terakhir</option>
                                        <option value="1 Bulan" {{ request('time') == '1 Bulan' ? 'selected' : '' }}>1 Bulan Terakhir</option>
                                    </select>
                                </div>
                            </div>
                            <div class="d-flex justify-content-between mt-3">
                                <a href="{{ route('video.index') }}" class="btn btn-link text-danger p-0">Bersihkan filter</a>
                                <div>
                                    <button type="button" class="btn btn-outline-secondary btn-sm me-2" data-bs-dismiss="dropdown">Batal</button>
                                    <button type="submit" class="btn btn-primary btn-sm">Terapkan</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

    @if(isset($videos) && $videos->count() > 0)
        <div class="row row-cols-1 row-cols-md-2 row-cols-lg-4 g-4">
            @foreach($videos as $video)
                <div class="col">
                    <div class="card h-100 video-card">
                        <div class="video-thumbnail">
                            <img src="{{ $video->thumbnail_url }}" class="card-img-top" alt="{{ $video->title }}">
                            <a href="{{ route('video.show', $video->video_id) }}" class="play-icon">
                                <i class="bi bi-play-circle"></i>
                            </a>
                            <span class="video-duration">10:30</span>
                        </div>
                        <div class="card-body">
                            <h5 class="card-title">{{ $video->title }}</h5>
                            <p class="card-text">
                                <i class="bi bi-tag me-1"></i>{{ $video->category->name }}
                            </p>
                        </div>
                        <div class="card-footer bg-transparent border-0">
                            <a href="{{ route('video.show', $video->video_id) }}" class="btn btn-link text-primary p-0">Tonton video</a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    @else
        <div class="alert alert-info" role="alert">
            <i class="bi bi-info-circle me-2"></i>Tidak ada video ditemukan.
        </div>
    @endif

    <nav aria-label="Page navigation" class="mt-4">
        {{ $videos->links('pagination::bootstrap-5') }}
    </nav>
</div>

@push('styles')
<style>
    :root {
        --primary-color: #FFD166;
        --secondary-color: #af8585;
        --text-color: #000000;
        --background-color: #f8f9fa;
    }

    body {
        background-color: var(--background-color);
        color: var(--text-color);
    }

    .btn-primary {
        background-color: var(--primary-color);
        border: none;
        color: var(--text-color);
        font-weight: bold;
        transition: all 0.3s ease;
    }

    .btn-primary:hover {
        background-color: #ffc233;
        transform: translateY(-2px);
    }

    .btn-outline-primary {
        color: var(--secondary-color);
        border-color: var(--secondary-color);
    }

    .btn-outline-primary:hover {
        background-color: var(--secondary-color);
        color: white;
    }

    .dropdown-menu {
        box-shadow: 0 0.5rem 1rem rgba(0, 0, 0, 0.15);
        border: none;
        border-radius: 10px;
    }

    .form-label {
        font-weight: bold;
        color: var(--text-color);
    }

    .video-card {
        border: none;
        border-radius: 15px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        transition: all 0.3s ease;
        overflow: hidden;
    }

    .video-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 6px 12px rgba(0, 0, 0, 0.15);
    }

    .card-img-top {
        border-top-left-radius: 15px;
        border-top-right-radius: 15px;
        object-fit: cover;
        height: 200px;
        transition: all 0.3s ease;
    }

    .video-thumbnail {
        position: relative;
        overflow: hidden;
    }

    .play-icon {
        position: absolute;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        font-size: 3rem;
        color: #ffffff;
        opacity: 0.8;
        transition: all 0.3s ease;
    }

    .video-thumbnail:hover .play-icon {
        opacity: 1;
        transform: translate(-50%, -50%) scale(1.1);
    }

    .video-thumbnail:hover img {
        transform: scale(1.05);
    }

    .video-duration {
        position: absolute;
        bottom: 10px;
        right: 10px;
        background-color: rgba(0, 0, 0, 0.7);
        color: #ffffff;
        padding: 3px 8px;
        border-radius: 4px;
        font-size: 0.8rem;
    }

    .card-title {
        font-size: 1.2rem;
        font-weight: bold;
        color: var(--text-color);
    }

    .card-text {
        color: var(--text-color);
    }

    .pagination .page-link {
        color: var(--text-color);
        border: none;
        margin: 0 2px;
        border-radius: 5px;
    }

    .pagination .page-link:hover,
    .pagination .page-item.active .page-link {
        background-color: var(--primary-color);
        color: var(--text-color);
    }

    @media (max-width: 768px) {
        .dropdown-menu {
            width: 100% !important;
        }
        .row > .col-6 {
            width: 100%;
        }
    }
</style>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.7.2/font/bootstrap-icons.css">
@endpush
@endsection
