<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('judul')</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('style/admin.css') }}">
</head>
<body>
    <!-- Navbar -->
    <nav class="navbar navbar-dark sticky-top bg-dark flex-md-nowrap p-0 shadow">
        <a class="navbar-brand col-md-3 col-lg-2 me-0 px-3" href="{{route('admin.dashboard')}}">Admin Dashboard</a>
        <button class="navbar-toggler position-absolute d-md-none collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#sidebarMenu" aria-controls="sidebarMenu" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <input class="form-control form-control-dark w-100" type="text" placeholder="Search" aria-label="Search">
        <ul class="navbar-nav px-3">
            <li class="nav-item text-nowrap">
                <form id="logout-form" action="{{ route('logoutadmin') }}" method="POST">
                    @csrf
                    <button type="submit" class="nav-link btn btn-link" style="padding: 0; margin: 0;">Sign out</button>
                </form>
            </li>
        </ul>
    </nav>

    <div class="container-fluid">
        <div class="row">
            <!-- Sidebar -->
            <nav id="sidebarMenu" class="col-md-3 col-lg-2 d-md-block bg-light sidebar collapse">
                <div class="position-sticky sidebar-sticky">
                    <ul class="nav flex-column">
                        <li class="nav-item">
                            <a class="nav-link active" aria-current="page" href="{{route('admin.dashboard')}}">
                                <span data-feather="home"></span>
                                Dashboard
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('kelola.user') }}">
                                <span data-feather="users"></span>
                                Kelola Data User
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('kelola.kategori') }}">
                                <span data-feather="tag"></span>
                                Kelola Data Kategori
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('kelola.artikel') }}">
                                <span data-feather="file-text"></span>
                                Kelola Data Artikel
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('kelola.video') }}">
                                <span data-feather="video"></span>
                                Kelola Data Video
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('kelola.forum') }}">
                                <span data-feather="message-circle"></span>
                                Kelola Forum
                            </a>
                        </li>
                    </ul>
                </div>
            </nav>

            <!-- Main Content -->
            <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
                <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
                    <h1 class="h2">@yield('judul2')</h1>
                    <div class="btn-toolbar mb-2 mb-md-0">
                        <div class="btn-group me-2">
                            <button type="button" class="btn btn-sm btn-outline-secondary">Share</button>
                            <button type="button" class="btn btn-sm btn-outline-secondary">Export</button>
                        </div>
                    </div>
                </div>

               @yield('content')
                </div>
            </main>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://unpkg.com/feather-icons"></script>
    <script>
        feather.replace();
    </script>
</body>
</html>
