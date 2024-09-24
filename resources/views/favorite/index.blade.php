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
                    <a class="nav-link" href="#">Artikel</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">Video</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">Forum</a>
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
            <a href="#" class="active"><i class="bi bi-star-fill"></i> Favorite</a> <!-- Tombol aktif -->
        </div>
    </div>

   <!-- Content -->
   <div class="content">
    <div class="favorite-card">
        <h5><strong>Favorite for {{ $user->name ?? 'Guest' }}</strong></h5>
        @forelse($favorites as $favorite)
            <div class="favorite-item">
                <i class="bi bi-star"></i>
                <p>{{ $favorite->article ? $favorite->article->title : $favorite->video->title }}</p>
                <small>{{ $favorite->created_at->format('d M Y H:i') }}</small>
            </div>
        @empty
            <p>No favorites found.</p>
        @endforelse
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
