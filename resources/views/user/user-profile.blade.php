<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile User</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('style/usernavbar.css') }}">
</head>
<body>
    <nav class="navbar navbar-expand-lg ">
        <div class="container-fluid">
            <a class="navbar-brand " href="#">
                <img src="logo.png" >
                U-Productive
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link " href="#">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link " href="{{route('articles.index')}}">Artikel</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link " href="#">Video</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{route('forum.index')}}">Forum</a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle text-white" href="#" id="userDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="bi bi-person-circle"></i>
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="userDropdown">
                            <li><a class="dropdown-item" href="{{ route('user.profile') }}">Profile</a></li>
                            <li>
                                <form action="{{ route('logout') }}" method="POST" class="dropdown-item p-0 m-0">
                                    @csrf
                                    <button type="submit" class="btn btn-link text-decoration-none">Logout</button>
                                </form>
                            </li>
                        </ul>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <div class="container mt-4">
        <!-- Profile Header -->
        <div class="profile-header">
            <img src="{{ $user->profile_picture ? Storage::url($user->profile_picture) : asset('images/default-profile.png') }}" alt="Profile Picture" class="img-thumbnail" style="width: 150px; height: 150px;">
            <div class="profile-details">
                <h3>{{ $user->name }}</h3>
                <p>{{ '@' . strtolower(str_replace(' ', '_', $user->name)) }}</p>
                <p>{{ $user->email }}</p>
                <div class="stats">
                    <div class="stat-item">
                        <h4>{{ $articles->count() }}</h4>
                        <p>Articles</p>
                    </div>
                    <div class="stat-item">
                        <h4>{{ $videos->count() }}</h4>
                        <p>Videos</p>
                    </div>
                </div>
                <a href="{{ route('profile.edit') }}" class="btn btn-outline-secondary mt-3">Edit Profile</a>
            </div>
        </div>

        <!-- Profile Content -->
        <div class="profile-content">
            <h4>My Content</h4>
            <div class="row">
                <!-- Article Items -->
                @foreach($articles as $article)
                <div class="col-md-4 content-item">
                    <img src="{{ $article->thumbnail ? asset('storage/' . $article->thumbnail) : asset('images/default-article.png') }}" alt="{{ $article->title }}">
                    <h5>{{ $article->title }}</h5>
                    <p>Category: {{ $article->category->name }}</p>
                </div>
                @endforeach

                <!-- Video Items -->
                @foreach($videos as $video)
                <div class="col-md-4 content-item">
                    <iframe src="{{ $video->url }}" title="{{ $video->title }}" frameborder="0" allowfullscreen></iframe>
                    <h5>{{ $video->title }}</h5>
                    <p>Category: {{ $video->category->name }}</p>
                </div>
                @endforeach
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
