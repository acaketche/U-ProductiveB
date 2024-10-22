<!-- resources/views/home.blade.php -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>U-Productive</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.10.3/font/bootstrap-icons.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #e9ecef;
        }
        .navbar {
            background-color: #4b79a1;
        }
        .card {
            margin: 15px;
        }
        .btn-login, .btn-register {
            margin-left: 10px;
        }
        .ebook-section {
            padding: 10px;
            background-color: white;
            border-radius: 8px;
            text-align: center;
        }
        .ebook-section p {
            color: gray;
        }
    </style>
</head>
<body>

    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-dark">
        <div class="container">
            <a class="navbar-brand" href="#">U-Productive</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="#">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Artikel</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Video</a>
                    </li>
                </ul>
                <button class="btn btn-warning btn-login">Login</button>
                <button class="btn btn-primary btn-register">Register</button>
            </div>
        </div>
    </nav>

    <!-- Content -->
    <div class="container mt-4">
        <div class="row">
            <!-- Artikel Populer -->
<div class="col-md-6">
    <div class="card">
        <div class="card-header">
            Artikel Populer
        </div>
        <ul class="list-group list-group-flush">
            @foreach($articles as $article)
            <li class="list-group-item">
                <i class="bi bi-star-fill"></i>
                <!-- Link ke halaman detail artikel -->
                <a href="{{ route('articles.show', $article->article_id) }}">
                    <strong>{{ $article->title }}</strong>
                </a>
                <p class="mb-0 text-muted">{{ $article->description }}</p>
            </li>
            @endforeach
        </ul>
    </div>
</div>


            <!-- Video Populer -->
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">
                        Video Populer
                    </div>
                    <ul class="list-group list-group-flush">
                        @foreach($videos as $video)
                        <li class="list-group-item">
                            <i class="bi bi-play-circle"></i>
                            <a href="{{ $video->url }}" target="_blank">{{ $video->title }}</a>
                        </li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>

        <!-- Ebook Section -->
        <div class="row mt-4">
            <div class="col-md-12">
                <div class="ebook-section">
                    <h5>E-BOOK</h5>
                    <p>Body text for your whole article or post. We'll put in some lorem ipsum to show how a filled-out page might look:</p>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
