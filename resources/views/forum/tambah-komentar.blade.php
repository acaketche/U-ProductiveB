@extends('layout.navbar-guest')

@section('content')
    <!-- Tambahkan margin-top pada container agar form komentar tidak tertutup oleh navbar -->
    <div class="container-fluid mt-5" style="margin-top: 85px;"> <!-- Adjust this margin-top -->
        <div class="row">
            <!-- Sidebar di sebelah kiri -->
            <div class="col-md-8">
                <div class="sidebar1">
                    <div class="post-comment">
                        <div class="d-flex">
                            <img src="{{ Auth::user() && Auth::user()->profile_picture ? Storage::url(Auth::user()->profile_picture) : asset('images/default-profile.png') }}" alt="User Image" class="rounded-image">
                            <div>
                                @if ($post->user)
                                    <p>{{ $post->user->name }}</p>
                                @else
                                    <p class="card-text">User Tidak Ditemukan</p>
                                @endif
                                <p class="card-text">
                                    <small class="text-muted">{{ date('d M Y', strtotime($post->created_at)) }}</small>
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
                            <img src="{{ asset('https://via.placeholder.com/40') }}" alt="User Image" class="rounded-image1 me-3">
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
@endsection

@push('styles')
    <link href="{{ asset('style/forum.css') }}" rel="stylesheet">
@endpush

@push('scripts')
    <script>
        $(document).ready(function() {
            $('#commentForm').on('submit', function(e) {
                e.preventDefault();

                var content = $('#commentContent').val();
                var postId = $(this).data('post-id');

                if (content.trim() === "") {
                    alert("Komentar tidak boleh kosong.");
                    return;
                }

                $.ajax({
                    url: '{{ route("comments.store") }}',
                    method: 'POST',
                    data: {
                        _token: '{{ csrf_token() }}',
                        post_id: postId,
                        content: content
                    },
                    success: function(response) {
                        if (response && response.user) {
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
                        } else {
                            alert('Terjadi kesalahan dalam menerima respons dari server.');
                        }
                    },
                    error: function(xhr) {
                        alert('Terjadi kesalahan. Silakan coba lagi.');
                    }
                });
            });
        });
    </script>
@endpush
