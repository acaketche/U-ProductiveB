@guest
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
                <x-navbar.nav-item route="home" text="Home"/>
                <x-navbar.nav-item route="articles.index" text="Artikel"/>
                <x-navbar.nav-item route="video.index" text="Video"/>
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
            <x-navbar.nav-item route="home" text="Home"/>
            <x-navbar.nav-item route="articles.index" text="Artikel"/>
            <x-navbar.nav-item route="video.index" text="Video"/>
            <x-navbar.nav-item route="forum.index" text="Forum"/>
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
@endauth
