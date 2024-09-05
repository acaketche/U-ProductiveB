<!-- resources/views/forum.blade.php -->
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
                    <a class="nav-link" href="#">Artikel</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">Video</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link active text-black" href="#">Forum</a>
                </li>
            </ul>
            <a href="#" class="navbar-icon">
                <img src="{{ asset('https://via.placeholder.com/24') }}" alt="User Icon">
            </a>
        </div>
    </nav>

    <!-- Sidebar -->
    <div class="sidebar">
        <img src="{{ asset('https://via.placeholder.com/100') }}" alt="Profile Picture">
        <div class="profile-info">
            <p>Prof. Ayunda S.Kom, M.Kom</p>
            <p class="contact-info">+62 823 1478 5265</p>
            <p class="contact-info">ayunda@gmail.com</p>
        </div>
        <div class="menu">
            <a href="#"><i class="bi bi-person-circle"></i> Profile</a>
            <a href="#"><i class="bi bi-clock-history"></i> History</a>
            <a href="#"><i class="bi bi-star-fill"></i> Favorite</a>
        </div>
    </div>

    <!-- Content -->
    <div class="content">
        <div class="history-card">
            <h5>History</h5>
            @foreach($histories as $history)
            <div class="history-item">
                <p>{{ $history['title'] }}</p>
                <small>{{ $history['date'] }}</small>
            </div>
            @endforeach
        </div>
    </div>

    <!-- Gunakan asset helper untuk memuat JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
