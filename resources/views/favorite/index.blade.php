@extends('layout.navbar-guest')

@section('content')
    <!-- Sidebar -->
    <div class="sidebar">
        <img src="{{ asset('storage/' . $user->profile_picture) }}" alt="Profile Picture">
        <div class="profile-info">
            @if ($user)
                <p>{{ $user->name }}</p>
                <p class="contact-info">{{ $user->email }}</p>
            @else
                <p>Guest</p>
                <p class="contact-info">Email tidak tersedia</p>
            @endif
        </div>
        <div class="menu">
            <a href="{{ route('user.profile') }}"><i class="bi bi-person-circle"></i> Profile</a>
            <a href="{{route ('history.index')}}"><i class="bi bi-clock-history"></i> History</a>
            <a href="{{route('favorite.index')}}" class="active"><i class="bi bi-star-fill"></i> Favorite</a> <!-- Tombol aktif -->
        </div>
    </div>

   <!-- Content -->
   <div class="content">
    <!-- resources/views/favorite.blade.php -->
        <div class="text-center mb-3">
            <h3>My Favorite Posts</h3>
        </div>
        @foreach ($favorites as $favorite)
            <div class="card mb-3">
                <div class="card-header">
                    {{ Carbon\Carbon::parse($favorite->forumPost->created_at)->diffForHumans() }}
                </div>
                <div class="card-body">
                    <h5 class="card-title">{{ $favorite->forumPost->title }}</h5>
                    <p class="card-text">{{ $favorite->forumPost->content }}</p>
                </div>
                @if (Auth::check())
                <div class="card-footer text-muted">
                    {{-- <favorite
                        :post={{ $post->id }}
                        :favorited={{ $post->favorited() ? 'true' : 'false' }}
                        >
                    </favorite> --}}
                    <form action="{{route('post.unfavorite', $favorite->forumPost->post_id) }}" method="POST">
                        @csrf
                        <button type="submit">Hapus dari Favorit</button>
                    </form>
                </div>
                @endif
            </div>
        @endforeach
    </div>

@endsection

@push('styles')
    <link href="{{asset('style/favorite.css')}}" rel="stylesheet">
@endpush
