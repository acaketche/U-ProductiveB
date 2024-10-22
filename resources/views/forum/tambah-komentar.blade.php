<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Komentar - Forum U-Productive</title>
    <!-- Gunakan asset helper untuk memuat CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
    <link href="{{ asset('style/forum.css') }}" rel="stylesheet">
</head>

<body>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-custom">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">
                <img src="logo.png">
                U-Productive
            </a>
            <ul class="navbar-nav ms-auto d-flex flex-row mb-2 mb-lg-0">
                <li class="nav-item">
                    <a class="nav-link" href="#">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('articles.index') }}">Artikel</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('video.index') }}">Video</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link active text-black" href="{{ route('forum.index') }}">Forum</a>
                </li>
            </ul>
            <a href="#" class="navbar-icon">
                <img src="{{ asset('https://via.placeholder.com/24') }}" alt="User Icon">
            </a>
        </div>
    </nav>

    <div class="container-fluid mt-4">
        <div class="row">
            <!-- Sidebar di sebelah kiri -->
            <div class="col-md-8">
                <div class="sidebar1">
                    <div class="post-comment">
                        <div class="d-flex">
                            <img src="{{ Auth::user() && Auth::user()->profile_picture ? Storage::url(Auth::user()->profile_picture) : asset('images/default-profile.png') }}"  alt="User Image" class="rounded-image">
                            <div>
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
                            </div>
                        </div>
                    </div>

                    <!-- Form untuk menambahkan komentar -->
                    <form id="commentForm" action="{{ route('comments.store') }}" method="POST" data-post-id="{{ $post->post_id }}">
                        @csrf
                        <!-- Mengirimkan ID postingan sebagai input tersembunyi -->
                        <input type="hidden" name="post_id" value="{{ $post->post_id }}">
                        <div class="d-flex mb-3">
                            <img src="{{ asset('https://via.placeholder.com/50') }}" alt="User Image" class="rounded-image1 me-3">
                            <input type="text" name="content" id="commentContent" class="form-control rounded-pill" placeholder="Tuliskan Komentar Anda..." required>
                        </div>
                        <div class="form-actions">
                            <button type="submit" class="btn btn-primary">Kirim Komentar</button>
                            <a href="{{ route('forum.index') }}" class="btn btn-secondary">Kembali ke Forum</a>
                        </div>
                    </form>
                </div>
            </div>

            <!-- Kolom kanan untuk menampilkan komentar -->
            <div class="col-md-4">
                <h5>Komentar</h5>
                <div id="commentsContainer">
                    @foreach ($post->comments as $comment)
                        <div class="card mb-3">
                            <div class="card-body">
                                @if ($comment->user)
                                    <p>{{ $comment->user->name }}</p>
                                @else
                                    <p class="card-text">User Tidak Ditemukan</p>
                                @endif
                                <p class="card-text">{{ $comment->content }}</p>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>

    <!-- Gunakan asset helper untuk memuat JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
       $(document).ready(function() {
            $('#commentForm').on('submit', function(e) {
                e.preventDefault();

                var content = $('#commentContent').val();
                var postId = $(this).data('post-id'); // Ambil post_id dari atribut data-post-id

                $.ajax({
                    url: '{{ route("comments.store") }}', // Pastikan route ini benar
                    method: 'POST', // Gunakan metode POST
                    data: {
                        _token: '{{ csrf_token() }}',
                        post_id: postId,
                        content: content
                    },
                    success: function(response) {
                        console.log(response); // Tambahkan ini untuk debugging
                        // Pastikan respons server sesuai dengan apa yang Anda harapkan
                        if (response) {

                            var commentHtml = `
                                <div class="card mb-3">
                                    <div class="card-body">
                                        <p>${response.user.name}</p>
                                        <p class="card-text">${response.content}</p>
                                    </div>
                                </div>
                            `;
                            $('#commentsContainer').prepend(commentHtml);
                            $('#commentContent').val(''); // Reset input komentar
                        }
                    },
                    error: function(xhr) {
                        alert('Terjadi kesalahan. Silakan coba lagi.');
                    }
                });
            });
        });

    </script>
</body>

</html>
