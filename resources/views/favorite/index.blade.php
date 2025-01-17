@extends('layout.navbar-guest')

@section('content')
    <!-- Sidebar -->
    <div class="sidebar">
        <img src="{{ asset('storage/' . $user->profile_picture) }}" alt="Profile Picture">
        <div class="profile-info">
            @if ($user)
                <p>{{ $user->name }}</p>
                <p class="contact-info">{{ $user->email }}</p>
                <p class="contact-info">{{ Auth::user()->role }}</p>
            @else
                <p>Guest</p>
                <p class="contact-info">Email tidak tersedia</p>
            @endif
        </div>
        <div class="menu">
            <a href="{{ route('user.profile') }}"><i class="bi bi-person-circle"></i> Profile</a>
            <a href="{{ route('history.index') }}"><i class="bi bi-clock-history"></i> History</a>
            <a href="{{ route('favorite.index') }}" class="active"><i class="bi bi-star-fill"></i> Favorite</a>
        </div>
    </div>

   <!-- Content -->
   <div class="content">
        <div class="text-center mb-3">
            <h3>My Favorite Posts</h3>
        </div>
        @foreach ($favorites as $favorite)
            <div class="card mb-3">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <div>
                        {{ Carbon\Carbon::parse($favorite->forumPost->created_at)->diffForHumans() }}
                        <span> | Dibuat oleh: {{ $favorite->forumPost->user->name }}</span>
                    </div>
                    @if (Auth::check())
                        <form action="{{ route('post.unfavorite', $favorite->forumPost->post_id) }}" method="POST" style="display:inline;">
                            @csrf
                            {{-- <button type="submit" class="btn btn-link p-0 text-danger">
                                <i class="bi bi-trash"></i> <!-- Ikon tong sampah -->
                            </button> --}}
                        </form>
                    @endif
                </div>

                <div class="card-body">
                    <h5 class="card-title">
                        <a href="{{ route('forum.index', $favorite->forumPost->post_id) }}">
                            {{ $favorite->forumPost->title }}
                        </a>
                    </h5>
                    <p class="card-text">{{ $favorite->forumPost->content }}</p>
                </div>
            </div>
        @endforeach
    </div>
@endsection

@push('styles')
    <link href="{{ asset('style/favorite.css') }}" rel="stylesheet">
@endpush
