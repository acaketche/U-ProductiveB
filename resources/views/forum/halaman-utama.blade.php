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
                        <div class="favorite-action" >
                            <a class="animate-left add-to-fav" title="Favorite" post-slug="{{$post->slug }}" href="">
                                <i class="bi-star"></i>
                            </a>
                        </div>
                        <!-- Pemberitahuan -->
                        <div id="notification-{{ $post->post_id }}" class="notification" style="display:none; margin-top: 10px; color: green;">
                            Postingan sudah masuk ke dalam favorit!
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
    <style>
        /* CSS untuk mengubah ikon favorit saat aktif */
        .favorite-icon.bi-star-fill {
            color: blue; /* Warna saat ikon aktif (bintang penuh) */
        }
        .favorite-icon.bi-star {
            color: gray; /* Warna saat ikon tidak aktif */
        }
        /* Styling pemberitahuan favorit */
        .notification {
            color: green;
            font-weight: bold;
        }
    </style>
@endpush


@push('scripts')
    <!-- Load jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <script>
        $(document).on('click', function() {
            var postId = $(this).data('post-id');
            var icon = $(this);

            // Toggle status favorit
            $.ajax({
                url: '/favorite/' + postId,
                method: 'POST',
                data: {
                    _token: '{{ csrf_token() }}',
                },
                success: function(response) {
                    console.log("Response:", response); // Debug respons dari server
                    if (response.success) {
                        if (response.is_favorite) {
                            icon.removeClass('bi-star').addClass('bi-star-fill').css('color', 'blue');
                        } else {
                            icon.removeClass('bi-star-fill').addClass('bi-star').css('color', 'gray');
                        }
                        $('#notification-' + postId).text("Postingan telah masuk ke halaman favorit!").fadeIn().delay(2000).fadeOut();
                    }
                },
                error: function(xhr) {
                    console.error("Error:", xhr.responseText); // Debug jika ada error
                    alert("Terjadi kesalahan. Silakan coba lagi.");
                }
            });
        });
    </script>
@endpush

