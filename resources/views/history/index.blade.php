<!-- resources/views/history.blade.php -->
<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>History U-Productive</title>
    <!-- Gunakan asset helper untuk memuat CSS -->
    <link href="{{ asset('https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css') }}" rel="stylesheet">
    <link href="{{asset('style/history.css')}}" rel="stylesheet">
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
                    <a class="nav-link" href="{{route ('articles.index')}}">Artikel</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{route ('video.index')}}">Video</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">Forum</a>
                </li>
            </ul>
            <a href="#" class="navbar-icon">
                <img src="{{ asset('https://via.placeholder.com/24') }}" alt="User Icon">
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
            <a href="#" class="active"><i class="bi bi-clock-history"></i> History</a> <!-- Tombol aktif -->
            <a href="{{ route ('favorite.index')}}"><i class="bi bi-star-fill"></i> Favorite</a>
        </div>
    </div>

<!-- Content -->
<div class="content">
    <div class="history-card">
        <h5>History</h5> <!-- Hanya teks ini yang akan bold -->
        @foreach($histories as $history)
    <div class="history-item">
        @if(isset($history['article_id']))
            <p>Melihat Artikel: {{ $history['article']['title'] ?? 'Judul tidak tersedia' }}</p>
        @elseif(isset($history['video_id']))
            <p>Melihat Video: {{ $history['video']['title'] ?? 'Judul tidak tersedia' }}</p>
        @endif
        <small>{{ isset($history['viewed_at']) ? \Carbon\Carbon::parse($history['viewed_at'])->format('d M Y, H:i') : 'Tanggal tidak tersedia' }}</small>
    </div>
@endforeach

    </div>
</div>


    <!-- Gunakan asset helper untuk memuat JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
