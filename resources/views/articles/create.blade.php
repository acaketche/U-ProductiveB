<!-- resources/views/articles/create.blade.php -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Artikel Baru - U-Productive</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('style/article.css') }}">
</head>
<body>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-light bg-primary">
        <div class="container-fluid">
            <a class="navbar-brand text-white" href="#">
                <img src="{{ asset('images/logo.png') }}" class="logo"> U-Productive
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
                        <a class="nav-link text-black active" aria-current="page" href="{{ route('articles.index') }}">Artikel</a>
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

    <!-- Form Tambah Artikel Baru -->
    <div class="container mt-4">
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('articles.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="mb-3">
                <label for="judulArtikel" class="form-label">Judul Artikel</label>
                <input type="text" class="form-control" id="judulArtikel" name="title" placeholder="Masukkan Judul Artikel" required>
            </div>
            <div class="mb-3">
                <label for="kategoriArtikel" class="form-label">Kategori Artikel</label>
                <select name="category_id" class="form-select" required>
                    @foreach ($categories as $category)
                        <option value="{{ $category->category_id }}">{{ $category->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="mb-3">
                <label for="isiArtikel" class="form-label">Isi Artikel</label>
                <textarea class="form-control" id="isiArtikel" name="content" rows="5" placeholder="Tulis isi artikel di sini" required></textarea>
            </div>
            <div class="mb-3">
                <label for="uploadImage" class="form-label">Upload Gambar</label>
                <input class="form-control" type="file" id="uploadImage" name="image" required>
            </div>
            <div class="d-flex justify-content-between">
                <a href="{{ route('articles.index') }}" class="btn btn-secondary">&larr; Back</a>
                <button type="submit" class="btn btn-warning">Tambah Artikel</button>
            </div>
        </form>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
