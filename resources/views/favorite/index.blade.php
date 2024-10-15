<!-- resources/views/favorite.blade.php -->
<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Favorite U-Productive</title>
    <!-- Gunakan asset helper untuk memuat CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
    <link href="{{ asset('style/favorite.css') }}" rel="stylesheet">
</head>

<body>
    <!-- Navbar -->
    <nav class="navbar navbar-custom">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">
                <img src="https://via.placeholder.com/30" alt="Logo">
                U-Productive
            </a>
            <ul class="navbar-nav ms-auto d-flex flex-row mb-2 mb-lg-0">
                <li class="nav-item">
                    <a class="nav-link" href="#">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{route('articles.index')}}">Artikel</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{route('video.index')}}">Video</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{route('forum.index')}}">Forum</a>
                </li>
            </ul>
            <a href="#" class="navbar-icon">
                <img src="https://via.placeholder.com/24" alt="User Icon">
            </a>
        </div>
    </nav>

    <!-- Sidebar -->
    <div class="sidebar">
        <img src="{{ asset('storage/' . $user->profile_picture) }}" alt="Profile Picture">
        <div class="profile-info">
            @if ($user)
                <p>{{ $user->name }}</p>
                <p class="contact-info">{{ $user->email }}</p>
            @else
                <p>Guest</p>
                <p class="contact-info">Email tidak tersedia</p>
            @endif
        </div>
        <div class="menu">
            <a href="{{ route('user.profile') }}"><i class="bi bi-person-circle"></i> Profile</a>
            <a href="{{route ('history.index')}}"><i class="bi bi-clock-history"></i> History</a>
            <a href="{{route('favorite.index')}}" class="active"><i class="bi bi-star-fill"></i> Favorite</a> <!-- Tombol aktif -->
        </div>
    </div>

<<<<<<< HEAD
  <!-- Content -->
<div class="content">
    <div class="favorite-card">
        <h5><strong>Favorite for {{ $user->name ?? 'Guest' }}</strong></h5>
        @forelse($favorites as $favorite)
            <div class="favorite-item d-flex align-items-center justify-content-between">
                <!-- Form untuk toggle favorit -->
                <form action="{{ route('favorite.toggle', ['post_id' => $favorite->post_id]) }}" method="POST">
                    @csrf
                    <button type="submit" class="btn btn-link p-0 m-0">
                        <i class="bi bi-star-fill favorite-icon {{ $favorite->is_favorited ? 'active' : 'inactive' }}"></i>
                    </button>
                </form>

                <!-- Judul Artikel/Video -->
                <p class="mb-0">
                    @if ($favorite->article)
                        {{ $favorite->article->title }}
                    @elseif ($favorite->video)
                        {{ $favorite->video->title }}
                    @else
                        <em>Item favorit tidak ditemukan</em>
                    @endif
                </p>

                <!-- Tanggal Dibuat -->
                <small class="text-muted">{{ $favorite->created_at->format('d M Y H:i') }}</small>
=======
   <!-- Content -->
   <div class="content">
    <!-- resources/views/favorite.blade.php -->
        <div class="text-center mb-3">
            <h3>My Favorite Posts</h3>
        </div>
        @foreach ($favorites as $post)
        <div class="card mb-3">
            <div class="card-header">
                {{ Carbon\Carbon::parse($post->created_at)->diffForHumans() }}
>>>>>>> 38fb869e6d5bbac34f81d92d8ab0dadb585c05a9
            </div>
            <div class="card-body">
                <h5 class="card-title">{{ $post->title }}</h5>
                <p class="card-text">{{ $post->content }}</p>
            </div>
            @if (Auth::check())
            <div class="card-footer text-muted">
                <favorite
                    :post={{ $post->id }}
                    :favorited={{ $post->favorited() ? 'true' : 'false' }}
                    >
                </favorite>
                <form action="{{ url('/post/' . $post->post_id . '/unfavorite') }}" method="POST">
                    @csrf
                    <button type="submit">Hapus dari Favorit</button>
                </form>
            </div>
            @endif
        </div>
        @endforeach
    </div>
</div>

</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
