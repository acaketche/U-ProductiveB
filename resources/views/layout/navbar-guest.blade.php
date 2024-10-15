<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>U-PRODUCTIVE</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('navbar.css') }}">
    @stack('styles')
</head>
<body>
    <x-navbar.index />
    {{-- @guest
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
                        <a class="nav-link text-white" href="{{route('home')}}">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{route('articles.index')}}">Artikel</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" href="{{ route('video.index') }}">Video</a>
                    </li>
                    <li class="nav-item">
                        <a class="btn btn-warning me-2" href="{{route('login')}}">Login</a>
                    </li>
                    <li class="nav-item">
                        <a class="btn btn-outline-secondary" href="{{route('register')}}">Register</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    @endguest
    @auth
    <nav class="navbar navbar-custom">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">
                <img src="{{ asset('storage/images/logo.png') }}" alt="Logo" style="width: 50px;">
                U-Productive
            </a>
            <ul class="navbar-nav ms-auto d-flex flex-row mb-2 mb-lg-0">
                <li class="nav-item">
                    <a class="nav-link" href="{{route('home')}}">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{route('articles.index')}}">Artikel</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{route('video.index')}}">Video</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link active text-black" href="{{route('forum.index')}}">Forum</a>
                </li>
                <!-- Dropdown should be part of the navbar list -->
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle text-dark" href="#" id="userDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        <i class="bi bi-person-circle"></i>
                    </a>
                    <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="userDropdown">
                        <li><a class="dropdown-item" href="{{ route('user.profile') }}">Profile</a></li>
                        <li>
                            <form action="{{ route('logout') }}" method="POST" class="dropdown-item p-0">
                                @csrf
                                <button type="submit" class="btn btn-link text-decoration-none">Logout</button>
                            </form>
                        </li>
                    </ul>
                </li>
            </ul>
        </div>
    </nav>


    @endauth --}}


    @yield('content')

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://unpkg.com/feather-icons"></script>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>

