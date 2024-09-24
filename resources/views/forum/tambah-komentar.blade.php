<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Komentar - Forum U-Productive</title>
    <!-- Gunakan asset helper untuk memuat CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
    <link href="{{ asset('style/forum.css') }}" rel="stylesheet">
</head>

<body>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-custom">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">
                <img src="logo.png">
                U-Productive
            </a>
            <ul class="navbar-nav ms-auto d-flex flex-row mb-2 mb-lg-0">
                <li class="nav-item">
                    <a class="nav-link" href="#">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('articles.index') }}">Artikel</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">Video</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link active text-black" href="{{ route('forum.index') }}">Forum</a>
                </li>
            </ul>
            <a href="#" class="navbar-icon">
                <img src="{{ asset('https://via.placeholder.com/24') }}" alt="User Icon">
            </a>
        </div>
    </nav>

    <div class="container-fluid mt-4">
        <div class="row">
            <!-- Sidebar di sebelah kiri -->
            <div class="col-md-8">
                <div class="sidebar1">
                    <div class="post-comment">
                        <div class="d-flex">
                            <img src="{{ asset('https://via.placeholder.com/50') }}" alt="User Image" class="rounded-image">
                            <div>
                                @if ($post->user)
                                    <p class="card-text">{{ $post->user->name }}</p>
                                @else
                                    <p class="card-text">User Tidak Ditemukan</p>
                                @endif
                                <p class="card-text">
                                    <small class="text-muted">
                                        {{ date('d M Y', strtotime($post->created_at)) }}
                                    </small>
                                </p>
                                <p>{{ $post->content }}</p>
                            </div>
                        </div>
                    </div>

                    <!-- Form untuk menambahkan komentar -->
                    <form action="{{ route('comments.store') }}" method="POST">
                        @csrf
                        <!-- Mengirimkan ID postingan sebagai input tersembunyi -->
                        <input type="hidden" name="post_id" value="{{ $post->post_id }}">
                        <div class="d-flex mb-3">
                            <img src="{{ asset('https://via.placeholder.com/50') }}" alt="User Image" class="rounded-image1 me-3">
                            <input type="text" name= "content" class="form-control rounded-pill" placeholder="Tuliskan Komentar Anda..." required>
                        </div>
                        <div class="form-actions">
                            <button type="submit" class="btn btn-primary">Kirim Komentar</button>
                            <a href="{{ route('forum.index') }}" class="btn btn-secondary">Kembali ke Forum</a>
                        </div>
                    </form>
                </div>
            </div>

            <!-- Kolom kanan untuk menampilkan komentar -->
            <div class="col-md-4">
                <h5>Komentar</h5>
                @foreach ($post->comments as $comment)
                    <div class="card mb-3">
                        <div class="card-body">
                            @if ($post->user)
                                    <p class="card-text">{{ $post->user->name }}</p>
                                @else
                                    <p class="card-text">User Tidak Ditemukan</p>
                             @endif
                            <p class="card-text"><small class="text-muted">{{ date('d M Y', strtotime($comment->created_at)) }}</small></p>
                            <p class="card-text">{{ $comment->content }}</p>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>

    <!-- Gunakan asset helper untuk memuat JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
