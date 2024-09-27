@extends('layout.navbar-guest')
@section('content')
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
                <div class="card h-100 position-relative">
                <img src="{{ Storage::url($article->image) }}" class="card-img-top" alt="{{ $article->title }}">
                <h5>{{ $article->title }}</h5>
                <p>Category: {{ $article->category->name }}</p>
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
