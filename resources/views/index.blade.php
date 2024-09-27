@extends('layout.navbar-guest')
@section('content')
    <!-- Main Content -->
<div class="container mt-4">
    <div class="row">
        <!-- Artikel Populer Section -->
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">
                    <h4>Artikel Populer</h4>
                </div>
                <ul class="list-group list-group-flush">
                    @foreach($articles as $article)
                    <li class="list-group-item">
                        <span>☆ {{ $article->title }}</span>
                        <a href="{{ route('articles.show', $article->article_id) }}">Lihat Artikel</a>
                    </li>
                    @endforeach
                </ul>
            </div>
        </div>

        <!-- Video Populer Section -->
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">
                    <h4>Video Populer</h4>
                </div>
                <ul class="list-group list-group-flush">
                    @foreach($videos as $video)
                        <li class="list-group-item">
                            <span>☆ {{ $video->title }}</span>
                            <a href="{{ $video->url }}" target="_blank">{{ $video->url }}</a>
                        </li>
                    @endforeach
                </ul>
            </div>
        </div>
    </div>

    <!-- Footer E-Book Section -->
    <div class="row mt-4">
        <div class="col-md-6">
            <div class="card">
                <a href="https://www.example.com/ebook" target="_blank" class="text-decoration-none text-dark">
                    <div class="card-body">
                        <h5 class="card-title">E-BOOK</h5>
                        <p class="card-text">Body text for your whole article or post. We’ll put in some lorem ipsum to show how a filled-out page might look:</p>
                    </div>
                </a>
            </div>
        </div>
    </div>
</div>
@endsection
