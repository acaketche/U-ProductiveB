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
                        <p> <img src="{{ $post->user && $post->user->profile_picture ? Storage::url($post->user->profile_picture) : asset('images/default-profile.png') }}" alt="User Image" class="rounded-image" style="width: 50px; height: 50px;">
                            {{ $post->user->name ?? 'User Tidak Ditemukan' }}
                        </p>
                    @endif
                    <p class="card-text">
                        <small class="text-muted">
                            {{ date('d M Y', strtotime($post->created_at)) }}
                        </small>
                    </p>
                    <p class="card-text">{{ $post->content }}</p>

                    <div class="comment-section">
                        <div class="text-muted text-primary">
                            <!-- Gunakan Blade untuk menentukan apakah ikon sudah difavoritkan -->
                            <i class="bi bi-star-fill me-3 {{ $post->isFavorited ? 'favorited text-primary' : '' }}"
                                style="font-size: 1.5em; cursor: pointer;"
                                data-post-id="{{ $post->post_id }}" id="favorite-icon-{{ $post->post_id }}"
                                data-is-favorited="{{ $post->isFavorited ? 'true' : 'false' }}"></i>

                            <!-- Form untuk menambah atau menghapus favorit -->
                            @if ($post->isFavorited)
                                <form action="{{ url('/post/' . $post->post_id . '/unfavorite') }}" method="POST" class="favorite-form">
                                    @csrf
                                    <button type="submit" style="display: none;"></button>
                                </form>

                                <!-- Notifikasi -->
                                <div id="favorite-notification" style="display: none; background-color: #28a745; color: white; padding: 20px; border-radius: 5px; position: fixed; bottom: 20px; right: 20px; z-index: 9999; box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);">
                                    Favorite berhasil dihapus!
                                </div>

                            @else
                                <form action="{{ url('/post/' . $post->post_id . '/favorite') }}" method="POST" class="favorite-form">
                                    @csrf
                                    <button type="submit" style="display: none;"></button>
                                </form>

                                <!-- Notifikasi -->
                                <div id="favorite-notification" style="display: none; background-color: #28a745; color: white; padding: 20px; border-radius: 5px; position: fixed; bottom: 20px; right: 20px; z-index: 9999; box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);">
                                    Favorite berhasil ditambahkan!
                                </div>
                            @endif
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
        const starIcons = document.querySelectorAll('.bi-star-fill');

        starIcons.forEach(icon => {
            const postId = icon.getAttribute('data-post-id');
            const isFavorited = icon.getAttribute('data-is-favorited') === 'true';

            // Cek jika ikon ini sudah pernah difavoritkan sebelumnya dan ubah tampilannya
            if (isFavorited) {
                icon.style.color = 'blue';
                icon.classList.add('favorited');
            } else {
                icon.style.color = ''; // reset ke warna default
                icon.classList.remove('favorited');
            }

            // Cek localStorage untuk status favorit agar tetap berwarna biru ketika reload/pindah halaman
            const storedFavoriteStatus = localStorage.getItem('favorite-' + postId);
            if (storedFavoriteStatus === 'true') {
                icon.style.color = 'blue';
                icon.classList.add('favorited');
            }

            // Event listener untuk klik ikon
            icon.addEventListener('click', async (event) => {
                const isCurrentlyFavorited = icon.classList.contains('favorited');

                // Jika sudah dalam status "favorited" dan user mengklik, hapus favorit
                if (isCurrentlyFavorited) {
                    const response = await toggleFavorite(postId, 'unfavorite', icon);
                    if (response) {
                        // Set warna kembali ke default dan ubah atribut
                        icon.style.color = '';
                        icon.classList.remove('favorited');
                        localStorage.setItem('favorite-' + postId, 'false');
                        showFavoriteNotification('Favorite berhasil dihapus!');
                    }
                }
                // Jika belum favorited dan user mengklik, tambahkan ke favorit
                else {
                    const response = await toggleFavorite(postId, 'favorite', icon);
                    if (response) {
                        icon.style.color = 'blue';
                        icon.classList.add('favorited');
                        localStorage.setItem('favorite-' + postId, 'true');
                        showFavoriteNotification('Favorite berhasil ditambahkan!');
                    }
                }
            });
        });
    });

    // Fungsi untuk toggle favorit status
    async function toggleFavorite(postId, action, icon) {
        const url = `/post/${postId}/${action}`;
        try {
            const response = await fetch(url, {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}',
                    'Content-Type': 'application/json',
                },
            });
            if (response.ok) {
                return true;
            } else {
                console.error('Gagal mengubah status favorit:', response.statusText);
                return false;
            }
        } catch (error) {
            console.error('Gagal menambah/menghapus favorit:', error);
            return false;
        }
    }

    // Fungsi untuk menampilkan notifikasi
    function showFavoriteNotification(message) {
        var notification = document.getElementById('favorite-notification');
        notification.innerText = message; // Ganti teks notifikasi sesuai status favorit
        notification.style.display = 'block';
        setTimeout(function() {
            notification.style.display = 'none'; // Menyembunyikan notifikasi setelah 3 detik
        }, 3000);
    }
</script>

