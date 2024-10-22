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
            <a href="{{route('history.index')}}"><i class="bi bi-clock-history"></i> History</a>
            <a href="{{route('favorite.index')}}"><i class="bi bi-star-fill"></i> Favorite</a>
        </div>
    </div>

    <!-- Content -->
    <div class="content">
        <form action="{{ route('forum.store') }}" method="POST" class="d-flex align-items-start gap-4">
            @csrf
            <textarea name="content" class="form-control flex-grow-1" placeholder="Tuliskan Postingan Anda..." required></textarea>
            <button type="submit" class="btn btn-primary1 align-self-end">Post</button>
        </form>

        @foreach ($posts as $post)
            <div class="card">
                <div class="card-body">
                    @if ($post->user)
                        <p>{{ $post->user->name }}</p>
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
                        <!-- Ikon bintang untuk menambahkan favorite -->
                        <i class="bi {{ $post->is_favorite ? 'bi-star-fill' : 'bi-star' }} favorite-icon" 
                           style="font-size: 1.5em; cursor: pointer; color: {{ $post->is_favorite ? 'gold' : 'gray' }};" 
                           data-post-id="{{ $post->post_id }}"></i>

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
    <style>
        /* CSS untuk mengubah ikon favorit saat aktif */
        .favorite-icon.bi-star-fill {
            color: gold; /* Warna saat ikon aktif (bintang penuh) */
        }
        .favorite-icon.bi-star {
            color: gray; /* Warna saat ikon tidak aktif */
        }
    </style>
@endpush

@push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            // Mengambil semua ikon bintang
            const favoriteIcons = document.querySelectorAll('.favorite-icon');

            favoriteIcons.forEach(icon => {
                icon.addEventListener('click', (event) => {
                    const postId = event.target.getAttribute('data-post-id');

                    if (postId) {
                        // Mengirim permintaan POST ke server
                        fetch(`/favorite/${postId}`, {
                            method: 'POST',
                            headers: {
                                'Content-Type': 'application/json',
                                'X-CSRF-TOKEN': '{{ csrf_token() }}'
                            },
                            body: JSON.stringify({ postId: postId })
                        })
                        .then(response => response.json())
                        .then(data => {
                            // Mengubah ikon berdasarkan status favorit
                            if (data.is_favorite) {
                                icon.classList.remove('bi-star');
                                icon.classList.add('bi-star-fill');
                                icon.style.color = 'gold'; // Bintang aktif
                            } else {
                                icon.classList.remove('bi-star-fill');
                                icon.classList.add('bi-star');
                                icon.style.color = 'gray'; // Bintang tidak aktif
                            }
                        })
                        .catch(error => console.error('Error:', error));
                    } else {
                        console.error('Post ID not found!');
                    }
                });
            });
        });
    </script>
@endpush
