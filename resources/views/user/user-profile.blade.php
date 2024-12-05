@extends('layout.navbar-guest')
@section('content')
@php
    use Carbon\Carbon;
@endphp
<div class="container mt-4">
    <!-- Profile Header -->
    <div class="profile-header">
        <img src="{{ $user->profile_picture ? Storage::url($user->profile_picture) : asset('images/default-profile.png') }}" class="img-thumbnail">
        <div class="profile-details">
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
        <ul class="nav nav-tabs" id="profileTab" role="tablist">
            <li class="nav-item" role="presentation">
                <button class="nav-link active" id="articles-tab" data-bs-toggle="tab" data-bs-target="#articles" type="button" role="tab">Articles</button>
            </li>
            <li class="nav-item" role="presentation">
                <button class="nav-link" id="videos-tab" data-bs-toggle="tab" data-bs-target="#videos" type="button" role="tab">Videos</button>
            </li>
        </ul>
        <div class="tab-content mt-3" id="profileTabContent">
            <!-- Articles Tab -->
            <div class="tab-pane fade show active" id="articles" role="tabpanel">
                <div class="row">
                    @forelse($articles as $article)
                        <div class="col-md-4 content-item">
                            <div class="card h-100 position-relative">
                                <a href="{{ route('articles.show', $article->article_id) }}">
                                    <img src="{{ Storage::url($article->image) }}" class="card-img-top" alt="{{ $article->title }}">
                                </a>
                                <div class="card-body">
                                    <h5 class="card-title">{{ $article->title }}</h5>
                                    <p class="card-text">{{ Str::limit($article->content, 100) }}</p>
                                    <p class="small text-muted">Published on: {{ Carbon::parse($article->created_at)->format('F j, Y') }}</p>
                                </div>
                            </div>
                        </div>
                    @empty
                        <p>No articles available.</p>
                    @endforelse
                </div>
            </div>

            <!-- Videos Tab -->
            <div class="tab-pane fade" id="videos" role="tabpanel">
                <div class="row">
                    @forelse($videos as $video)
                        <div class="col-md-4 content-item">
                            <div class="card h-100 position-relative">
                                <a href="{{ route('video.show', $video->video_id) }}" class="video-thumbnail">
                                    <img src="{{ $video->thumbnail_url }}" class="card-img-top" alt="{{ $video->title }}">
                                    <div class="play-icon">
                                        <i class="bi bi-play-circle"></i>
                                    </div>
                                </a>
                                <h5>{{ $video->title }}</h5>
                                <p class="small text-muted">Published on: {{ Carbon::parse($video->created_at)->format('F j, Y') }}</p>
                            </div>
                        </div>
                    @empty
                        <p>No videos available.</p>
                    @endforelse
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('styles')
<link rel="stylesheet" href="{{ asset('style/usernavbar.css') }}">
@endpush
