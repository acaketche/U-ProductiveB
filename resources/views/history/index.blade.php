@extends('layout.navbar-guest')

@section('content')
    <!-- Sidebar -->
    <div class="sidebar">
        <img src="{{ Auth::user() && Auth::user()->profile_picture ? Storage::url(Auth::user()->profile_picture) : asset('images/default-profile.png') }}" >
        <div class="profile-info">
            @if (Auth::check())
                <p>{{ Auth::user()->name }}</p>
                <p class="contact-info">{{ Auth::user()->email }}</p>
                <p class="contact-info">{{ Auth::user()->role }}</p>
            @else
                <p>Guest</p>
                <p class="contact-info">Email tidak tersedia</p>
            @endif
        </div>
        <div class="menu">
            <a href="{{route('user.profile')}}"><i class="bi bi-person-circle"></i> Profile</a>
            <a href="#"  class="active"><i class="bi bi-clock-history"></i> History</a>
            <a href="{{route('favorite.index')}}"><i class="bi bi-star-fill"></i> Favorite</a>
        </div>
    </div>

    <!-- Content -->
    <div class="container mt-4" style="max-width: 800px; margin: auto;">
        <h3 class="mb-4">History</h3>
        <div class="row">
            <!-- Card for Articles -->
            <div class="col-12 mb-3">
                <div class="card shadow-sm">
                    <div class="card-body">
                        <h5 class="card-title">Melihat Artikel</h5>
                        @foreach($histories as $history)
                            @if($history->article)
                                <p class="card-text">
                                    <a href="{{ route('articles.show', $history->article->article_id) }}">
                                        {{ $history->article->title ?? 'Judul tidak tersedia' }}
                                    </a>
                                </p>
                                <p class="text-muted small mb-0">
                                    {{ $history->viewed_at ? \Carbon\Carbon::parse($history->viewed_at)->timezone('Asia/Jakarta')->format('d M Y, H:i') : 'Tanggal tidak tersedia' }}
                                </p>
                                <hr>
                            @endif
                        @endforeach
                    </div>
                </div>
            </div>

            <!-- Card for Videos -->
            <div class="col-12 mb-3">
                <div class="card shadow-sm">
                    <div class="card-body">
                        <h5 class="card-title">Melihat Video</h5>
                        @foreach($histories as $history)
                            @if($history->video)
                                <p class="card-text">
                                    <a href="{{ route('video.show', $history->video->video_id) }}">
                                        {{ $history->video->title ?? 'Judul tidak tersedia' }}
                                    </a>
                                </p>
                                <p class="text-muted small mb-0">
                                    {{ $history->viewed_at ? \Carbon\Carbon::parse($history->viewed_at)->timezone('Asia/Jakarta')->format('d M Y, H:i') : 'Tanggal tidak tersedia' }}
                                </p>
                                <hr>
                            @endif
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('styles')
    <link href="{{asset('style/history.css')}}" rel="stylesheet">
@endpush
