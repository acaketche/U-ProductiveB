<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>U-Productive</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('style/article.css') }}">
    <style>
        .card-img-top {
            object-fit: cover;
            height: 150px; /* Atur tinggi gambar sesuai kebutuhan */
        }
    </style>
</head>
<body>
    <nav class="navbar navbar-expand-lg bg-primary">
        <div class="container-fluid">
            <a class="navbar-brand text-white" href="#">
                <img src="{{ asset('images/logo.png') }}" class="logo">
                U-Productive
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link text-white" href="#">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active text-black" aria-current="page" href="{{ route('articles.index') }}">Artikel</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-white" href="#">Video</a>
                    </li>
                    <li class="nav-item">
                        <button class="btn btn-warning me-2">Login</button>
                    </li>
                    <li class="nav-item">
                        <button class="btn btn-outline-secondary">Register</button>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <div class="container mt-4">
        <div class="d-flex justify-content-center align-items-center mb-4">
            <button class="btn btn-primary me-2" onclick="window.location.href='{{ route('articles.create') }}';">
                <i class="bi bi-plus me-2"></i>Tambah
            </button>
            <div class="d-flex">
                <!-- Form to handle search and filter -->
                <form action="{{ route('articles.index') }}" method="GET" class="d-flex">
                    <!-- Search input -->
                    <input type="text" name="search" class="form-control me-2" placeholder="Cari Artikel" value="{{ request('search') }}">

                    <!-- Filter Dropdown Form -->
                    <form action="{{ route('articles.index') }}" method="GET" class="dropdown-center">
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
                                <a href="{{ route('articles.index') }}" class="btn btn-link text-danger p-0">Bersihkan filter</a>
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

        <div class="row">
            @foreach ($articles as $article)
            <div class="col-md-4 mb-4">
                <div class="card h-100 position-relative">
                    <!-- Image wrapped with link -->
                    <a href="{{ route('articles.show', $article->article_id) }}">
                        <img src="{{ Storage::url($article->image) }}" class="card-img-top" alt="{{ $article->title }}">
                    </a>
                    <div class="card-body">
                        <h5 class="card-title">{{ $article->title }}</h5>
                        <p class="card-text">{{ $article->content }}</p>
                    </div>
                </div>
            </div>
            @endforeach
        </div>


        <nav aria-label="Page navigation">
            <ul class="pagination justify-content-end">
                <li class="page-item"><a class="page-link" href="#">Previous</a></li>
                <li class="page-item"><a class="page-link" href="#">1</a></li>
                <li class="page-item"><a class="page-link" href="#">2</a></li>
                <li class="page-item"><a class="page-link" href="#">3</a></li>
                <li class="page-item"><a class="page-link" href="#">...</a></li>
                <li class="page-item"><a class="page-link" href="#">68</a></li>
                <li class="page-item"><a class="page-link" href="#">Next</a></li>
            </ul>
        </nav>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://unpkg.com/feather-icons"></script>
</body>
</html>
