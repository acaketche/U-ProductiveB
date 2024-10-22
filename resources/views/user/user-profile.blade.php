@extends('layout.navbar-guest')
@section('content')
<div class="container mt-4">
    <!-- Profile Header -->
<<<<<<< HEAD
    <div class="profile-header d-flex align-items-center">
        <img src="{{ $user->profile_picture ? Storage::url($user->profile_picture) : asset('images/default-profile.png') }}" alt="Profile Picture" class="img-thumbnail" style="width: 150px; height: 150px;">
        <div class="profile-details ms-4">
=======
    <div class="profile-header">
        <img src="{{ $user->profile_picture ? Storage::url($user->profile_picture) : asset('images/default-profile.png') }}" class="img-thumbnail" alt="Profile Picture">
        <div class="profile-details">
>>>>>>> 7d466ada0dee1427e10bd06e8cf698cb6e7d0c9f
            <h3>{{ $user->name }}</h3>
            <p class="username">{{ '@' . strtolower(str_replace(' ', '_', $user->name)) }}</p>
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
            <div class="col-md-4 content-item">
                <div class="card h-100 position-relative">
                    <a href="{{ route('articles.show', $article->article_id) }}">
                        <img src="{{ Storage::url($article->image) }}" class="card-img-top" alt="{{ $article->title }}">
                    </a>
                    <div class="card-body">
                        <h5 class="card-title">{{ $article->title }}</h5>
                        <p class="card-text">{{ Str::limit($article->content, 100) }}</p>
                    </div>
                </div>
            </div>
            @endforeach

            <!-- Video Items -->
            @foreach($videos as $video)
            <div class="col-md-4 content-item">
                <div class="card h-100 position-relative">
                    <a href="{{ route('video.show', $video->video_id) }}" class="video-thumbnail">
                        <img src="{{ $video->thumbnail_url }}" class="card-img-top" alt="{{ $video->title }}">
                        <div class="play-icon">
                            <i class="bi bi-play-circle"></i>
                        </div>
                    </a>
                    <h5>{{ $video->title }}</h5>
                    <p>Category: {{ $video->category->name }}</p>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</div>
@endsection

@push('styles')
<link rel="stylesheet" href="{{ asset('style/usernavbar.css') }}">
@endpush
