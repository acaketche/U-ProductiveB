@extends('layout.navbar-user')

@section('judul')
    Profil Pengguna
@endsection

@section('content')
<div class="container mt-4">
    <!-- Profile Header -->
    <div class="profile-header d-flex align-items-center">
        <img src="{{ $user->profile_picture ? Storage::url($user->profile_picture) : asset('images/default-profile.png') }}" alt="Profile Picture" class="img-thumbnail" style="width: 150px; height: 150px;">
        <div class="profile-details ms-4">
            <h3>{{ $user->name }}</h3>
            <p>{{ '@' . strtolower(str_replace(' ', '_', $user->name)) }}</p>
            <p>{{ $user->email }}</p>
            <div class="d-flex">
                <div class="stat-item me-4">
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
    <div class="profile-content mt-4">
        <h4>My Content</h4>
        <div class="row">
            <!-- Article Items -->
            @foreach($articles as $article)
                <div class="col-md-4 content-item mb-4">
                    <img src="{{ $article->thumbnail ? asset('storage/' . $article->thumbnail) : asset('images/default-article.png') }}" alt="{{ $article->title }}" class="img-fluid">
                    <h5>{{ $article->title }}</h5>
                    <p>Category: {{ $article->category->name }}</p>
                </div>
            @endforeach

            <!-- Video Items -->
            @foreach($videos as $video)
                <div class="col-md-4 content-item mb-4">
                    <iframe src="{{ $video->url }}" title="{{ $video->title }}" frameborder="0" allowfullscreen class="w-100"></iframe>
                    <h5>{{ $video->title }}</h5>
                    <p>Category: {{ $video->category->name }}</p>
                </div>
            @endforeach
        </div>
    </div>
</div>
@endsection
