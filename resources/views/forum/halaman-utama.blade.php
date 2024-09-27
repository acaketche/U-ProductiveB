@extends('layout.navbar-guest')
@section('content')
    <!-- Sidebar -->
    <div class="sidebar">
        <img src="{{ $user->profile_picture ? Storage::url($user->profile_picture) : asset('images/default-profile.png') }}" alt="Profile Picture">
        <div class="profile-info">
            @if ($user)
                <p>{{ $user->name }}</p>
                <p class="contact-info">{{ $user->email }}</p>
                <p class="contact-info">{{ $user->role}}</p>
            @else
                <p>Guest</p>
                <p class="contact-info">Email tidak tersedia</p>
            @endif
        </div>
        <div class="menu">
            <a href="{{route('user.profile')}}"><i class="bi bi-person-circle"></i> Profile</a>
            <a href="{{route('history.index')}}"><i class="bi bi-clock-history"></i> History</a>
            <a href="{{route('favorite.index')}}"><i class="bi bi-star-fill"></i> Favorite</a>
        </div>
    </div>

    <!-- Content -->
    <div class="content">
        <form action="{{ route('forum.store') }}" method="POST" class="d-flex align-items-start gap-4">
            @csrf
            <!-- Input fields -->
            <textarea name="content" class="form-control flex-grow-1" placeholder="Tuliskan Postingan Anda..." required></textarea>
            <button type="submit" class="btn btn-primary1 align-self-end">Post</button>
        </form>

       <!-- resources/views/forum.blade.php -->
       @foreach ($posts as $post)
           <div class="card">
                <div class="card-body">
                    @if ($user)
                    <p>{{ $user->name }}</p>
                @else
                    <p class="card-text">User Tidak Ditemukan</p>
                @endif
                    <p class="card-text">
                        <small class="text-muted">
                            {{ date('d M Y', strtotime($post->created_at)) }}
                        </small>
                    </p>
                    <p class="card-text">{{ $post->content }}</p>
                    <div class="comment-section">
                        <button class="btn-favorite">
                            <i class="bi bi-star-fill favorite-icon {{ $post->is_favorited ? 'active' : 'inactive' }}"></i>
                        </button>
                        <!-- Form untuk menambahkan komentar -->
                        <form action="{{ route('comments.create', ['post_id' => $post->post_id]) }}" method="GET">
                            <button type="submit" class="btn btn-primary2">Tambah Komentar</button>
                        </form>
                    </div>
               </div>
           </div>
       @endforeach

    </div>
@endsection

    @push('styles')
    <link href="{{asset('style/forum.css')}}" rel="stylesheet">
    @endpush
