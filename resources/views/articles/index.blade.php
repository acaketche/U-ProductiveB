@extends('layout.navbar-guest')
@section('content')
<div class="container mt-4">
    <div class="row justify-content-center mb-4">
        <div class="col-md-10">
            <div class="d-flex justify-content-center align-items-center flex-wrap">
                <form action="{{ route('articles.index') }}" method="GET" class="d-flex flex-grow-1 flex-wrap justify-content-center align-items-center">
                    <button class="btn btn-primary me-2 mb-2 mb-md-0" type="button" onclick="window.location.href='{{ route('articles.create') }}';">
                        <i class="bi bi-plus-lg me-1"></i>Tambah
                    </button>
                    <div class="input-group me-2 mb-2 mb-md-0 flex-grow-1" style="max-width: 300px;">
                        <input type="text" name="search" class="form-control" placeholder="Cari Artikel" value="{{ request('search') }}">
                        <button class="btn btn-outline-secondary" type="submit">
                            <i class="bi bi-search"></i>
                        </button>
                    </div>
                    <div class="dropdown mb-2 mb-md-0">
                        <button class="btn btn-outline-primary dropdown-toggle" type="button" id="filterDropdown" data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="bi bi-funnel me-1"></i>Filter
                        </button>
                        <div class="dropdown-menu p-3">
                            <div class="row g-3">
                                <div class="col-md-6">
                                    <label for="kategori" class="form-label">Kategori</label>
                                    <select class="form-select" id="kategori" name="category">
                                        <option value="">Pilih</option>
                                        @foreach ($categories as $category)
                                            <option value="{{ $category->category_id }}" {{ request('category') == $category->category_id ? 'selected' : '' }}>
                                                {{ $category->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-md-6">
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
                                <a href="{{ route('articles.index') }}" class="btn btn-link text-danger p-0">Bersihkan filter</a>
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

    <div class="row row-cols-1 row-cols-md-2 row-cols-lg-3 g-4">
        @foreach ($articles as $article)
        <div class="col">
            <div class="card h-100 article-card">
                <a href="{{ route('articles.show', $article->article_id) }}" class="card-img-link">
                    <img src="{{ Storage::url($article->image) }}" class="card-img-top" alt="{{ $article->title }}">
                </a>
                <div class="card-body">
                    <h5 class="card-title">{{ $article->title }}</h5>
                    <p class="card-text">{{ Str::limit($article->content, 100) }}</p>
                </div>
                <div class="card-footer bg-transparent border-0">
                    <a href="{{ route('articles.show', $article->article_id) }}" class="btn btn-link text-primary p-0">Baca selengkapnya</a>
                </div>
            </div>
        </div>
        @endforeach
    </div>

    <nav aria-label="Page navigation" class="mt-4">
        {{ $articles->links('pagination::bootstrap-5') }}
    </nav>
</div>
@endsection

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

    .article-card {
        border: none;
        border-radius: 15px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        transition: all 0.3s ease;
        overflow: hidden;
    }

    .article-card:hover {
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

    .card-img-link:hover .card-img-top {
        transform: scale(1.05);
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
