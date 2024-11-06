@extends('layout.navbar-guest')
@section('content')
    <!-- Sidebar -->
    <div class="sidebar">
        <img src="{{ Auth::user() && Auth::user()->profile_picture ? Storage::url(Auth::user()->profile_picture) : asset('images/default-profile.png') }}" alt="Profile Picture">
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
            <a href="{{ route('user.profile') }}"><i class="bi bi-person-circle"></i> Profile</a>
            <a href="{{ route('history.index') }}"><i class="bi bi-clock-history"></i> History</a>
            <a href="{{ route('favorite.index') }}"><i class="bi bi-star-fill"></i> Favorite</a>
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
            <div class="card mb-4">
                <div class="card-body">
                    @if (Auth::check())
                        <p>{{ $post->user->name ?? 'User Tidak Ditemukan' }}</p>
                    @endif
                    <p class="card-text">
                        <small class="text-muted">
                            {{ date('d M Y', strtotime($post->created_at)) }}
                        </small>
                    </p>
                    <p class="card-text">{{ $post->content }}</p>

                    <div class="comment-section">
                        <div class="text-muted text-primary">
                            <i class="bi bi-star me-3 {{ $post->isFavorited ? 'text-primary' : '' }}"
                               style="font-size: 1.5em; cursor: pointer; {{ $post->isFavorited ? 'color: blue;' : '' }}"
                               data-post-id="{{ $post->post_id }}" id="favorite-icon-{{ $post->post_id }}"></i>

                            <!-- Form untuk menambah atau menghapus favorit -->
                            @if ($post->isFavorited)
                                <form action="{{ url('/post/' . $post->post_id . '/unfavorite') }}" method="POST" class="favorite-form">
                                    @csrf
                                    <button type="submit" style="display: none;"></button>
                                </form>
                            @else
                                <form action="{{ url('/post/' . $post->post_id . '/favorite') }}" method="POST" class="favorite-form">
                                    @csrf
                                    <button type="submit" style="display: none;"></button>
                                </form>
                            @endif
                        </div>

                        <!-- Notifikasi -->
                        <div id="favorite-notification" style="display: none; background-color: #28a745; color: white; padding: 10px; border-radius: 5px;">
                            Favorite berhasil ditambahkan!
                        </div>

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

<script>
    document.addEventListener('DOMContentLoaded', () => {
        const starIcons = document.querySelectorAll('.bi-star');

        starIcons.forEach(icon => {
            icon.addEventListener('click', (event) => {
                const postId = event.target.getAttribute('data-post-id');
                const isFavorited = event.target.style.color === 'blue'; // Cek apakah ikon sudah berwarna biru

                // Update warna ikon (menggunakan CSS inline)
                const iconElement = document.getElementById(`favorite-icon-${postId}`);
                if (isFavorited) {
                    iconElement.style.color = ''; // Reset warna jika sudah biru
                } else {
                    iconElement.style.color = 'blue'; // Ubah warna menjadi biru
                }

                // Kirim form untuk mengubah status favorit
                const form = event.target.closest('div').querySelector('.favorite-form');
                form.querySelector('button').click(); // Submit form secara otomatis

                // Tampilkan notifikasi favorit berhasil ditambahkan
                showFavoriteNotification();
            });
        });
    });

    function showFavoriteNotification() {
        const notification = document.getElementById('favorite-notification');
        notification.style.display = 'block';

        // Sembunyikan notifikasi setelah 3 detik
        setTimeout(() => {
            notification.style.display = 'none';
        }, 3000);
    }
</script>

