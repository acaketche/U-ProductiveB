<!-- resources/views/create.blade.php -->
<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Postingan - U-Productive</title>
    <link href="{{ asset('https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css') }}" rel="stylesheet">
    <link href="{{ asset('style/forum.css') }}" rel="stylesheet">
</head>

<body>
    <!-- Navbar -->
    <nav class="navbar navbar-custom">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">
                <img src="{{ asset('https://via.placeholder.com/30') }}" alt="Logo">
                U-Productive
            </a>
            <ul class="navbar-nav ms-auto d-flex flex-row mb-2 mb-lg-0">
                <li class="nav-item">
                    <a class="nav-link" href="#">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">Artikel</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">Video</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link active text-black" href="#">Forum</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">History</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">Favorite</a>
                </li>
            </ul>
            <a href="#" class="navbar-icon">
                <img src="{{ asset('https://via.placeholder.com/24') }}" alt="User Icon">
            </a>
        </div>
    </nav>

    <!-- Form Tambah Postingan -->
    <div class="new-post-container">
        <form action="{{ route('forum.store') }}" method="POST" class="new-post-form">
            @csrf
            <div class="form-group d-flex justify-content-between align-items-center mb-4">
                <!-- Tombol Cancel -->
                <button type="button" class="btn btn-secondary" onclick="window.location.href='{{ route('forum.index') }}'">Cancel</button>

                <!-- Tombol Post -->
                <button type="submit" class="btn btn-primary">Post</button>
            </div>

            <!-- Area untuk Menulis Postingan -->
            <div class="post-input-area">
                <img src="{{ asset('https://via.placeholder.com/30') }}" alt="User Avatar" class="user-avatar">
                <textarea class="form-control post-textarea" name="body" placeholder="Tuliskan Postingan Anda..." rows="5"></textarea>
            </div>
        </form>
    </div>

    <!-- Gunakan asset helper untuk memuat JS -->
    <script src="{{ asset('https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js') }}"></script>
</body>

</html>
