<nav class="navbar navbar-expand-lg navbar-energetic">
    <div class="container">
        <a class="navbar-brand" href="#">
            <img src="{{ asset('storage/images/logo.png') }}"  class="logo">
            <span class="brand-text">U-Productive</span>
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ms-auto">
                <x-navbar.nav-item route="home" text="Home"/>
                <x-navbar.nav-item route="articles.index" text="Artikel"/>
                <x-navbar.nav-item route="video.index" text="Video"/>
                <x-navbar.nav-item route="informatica.index" text="Informatika"/>
                <x-navbar.nav-item route="teknik_sipil.index" text="Teknik Sipil"/>
                <x-navbar.nav-item route="teknik_computer.index" text="Teknik Komputer"/>
                @guest
                    <li class="nav-item">
                        <a class="btn btn-login" href="{{ route('login') }}">Login</a>
                    </li>
                    <li class="nav-item">
                        <a class="btn btn-register" href="{{ route('register') }}">Register</a>
                    </li>
                @else
                    <x-navbar.nav-item route="forum.index" text="Forum"/>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
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
                @endguest
            </ul>
        </div>
    </div>
</nav>
