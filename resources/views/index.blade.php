@extends('layout.navbar-guest')
@section('content')
<div class="container mt-4">
    <div class="row">
        <!-- Artikel Populer Section -->
        <div class="col-md-6 mb-4">
            <div class="card card-hover shadow-lg">
                <div class="card-header bg-gradient-primary text-white">
                    <h4 class="mb-0"><i class="fas fa-newspaper mr-2"></i>Artikel Populer</h4>
                </div>
                <ul class="list-group list-group-flush">
                    @forelse($articles as $article)
                    <li class="list-group-item d-flex justify-content-between align-items-center">
                        <span class="article-title"><i class="fas fa-star text-warning mr-2"></i>{{ $article->title }}</span>
                        <a href="{{ route('articles.show', $article->article_id) }}" class="btn btn-sm btn-outline-primary">Baca</a>
                    </li>
                    @empty
                    <li class="list-group-item">Belum ada artikel.</li>
                    @endforelse
                </ul>
            </div>
        </div>
        <!-- Video Populer Section -->
        <div class="col-md-6 mb-4">
            <div class="card card-hover shadow-lg">
                <div class="card-header bg-gradient-success text-white">
                    <h4 class="mb-0"><i class="fas fa-video mr-2"></i>Video Populer</h4>
                </div>
                <ul class="list-group list-group-flush">
                    @forelse($videos as $video)
                    <li class="list-group-item d-flex justify-content-between align-items-center">
                        <span class="video-title"><i class="fas fa-play-circle text-danger mr-2"></i>{{ $video->title }}</span>
                        <a href="{{ $video->url }}" target="_blank" class="btn btn-sm btn-outline-success">Tonton</a>
                    </li>
                    @empty
                    <li class="list-group-item">Belum ada video.</li>
                    @endforelse
                </ul>
            </div>
        </div>
    </div>
    <!-- E-Book Section -->
    <div class="row mt-4">
        <div class="col-md-12">
            <div class="card card-hover shadow-lg">
                <div class="card-body bg-gradient-info text-white">
                    <h4 class="card-title"><i class="fas fa-book mr-2"></i>E-BOOK</h4>
                    <p class="card-text">Temukan pengetahuan baru dalam e-book kami. Klik untuk mengeksplorasi dunia pengetahuan yang menunggu Anda!</p>
                    <a href="https://www.gramedia.com/blog/rekomendasi-e-book-paling-banyak-dibaca-di-gramedia-digital/?srsltid=AfmBOoqO2T6k_rZrTGDY9wdcGpnVrjEttMvdAjPbJlmWvOJ6XIOSzoyO" target="_blank" class="btn btn-light">Baca E-Book</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection


@push('styles')
<style>
    body {
        background-color: #f8f9fa;
    }
    .container {
        max-width: 1000px;
    }
    .card {
        border-radius: 15px;
        overflow: hidden;
        transition: all 0.3s ease;
    }
    .card-hover:hover {
        transform: translateY(-5px);
        box-shadow: 0 10px 20px rgba(0,0,0,0.2) !important;
    }
    .card-header {
        font-weight: bold;
        padding: 1rem;
    }
    .bg-gradient-primary {
        background: linear-gradient(45deg, #4e73df, #224abe);
    }
    .bg-gradient-success {
        background: linear-gradient(45deg, #1cc88a, #13855c);
    }
    .bg-gradient-info {
        background: linear-gradient(45deg, #36b9cc, #258391);
    }
    .list-group-item {
        border: none;
        padding: 1rem;
        transition: background-color 0.3s ease;
    }
    .list-group-item:hover {
        background-color: #f8f9fa;
    }
    .article-title, .video-title {
        font-weight: 500;
        color: #5a5c69;
    }
    .btn-sm {
        border-radius: 20px;
        padding: 0.25rem 0.75rem;
    }
    .shadow-lg {
        box-shadow: 0 1rem 3rem rgba(0,0,0,.175)!important;
    }
</style>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
@endpush
