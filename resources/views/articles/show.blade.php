<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Artikel - U-Productive</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('style/article.css') }}">
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
        <div class="card">
            <!-- Add inline style or custom class to limit the image height -->
            <img src="{{ asset('storage/' . $article->image) }}" class="card-img-top img-fluid" alt="{{ $article->title }}" style="max-height: 300px; object-fit: cover;">
            <div class="card-body">
                <h5 class="card-title">{{ $article->title }}</h5>

                <!-- Display author's name and category -->
                <p class="card-text">
                    <strong>Author:</strong> {{ $article->author }} <br>
                    <strong>Category:</strong> {{ $article->category->name }}
                </p>

                <p class="card-text">{{ $article->content }}</p>
                <a href="{{ route('articles.index') }}" class="btn btn-primary">Kembali ke Daftar Artikel</a>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://unpkg.com/feather-icons"></script>
</body>
</html>
