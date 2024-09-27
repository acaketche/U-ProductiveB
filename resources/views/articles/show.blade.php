@extends('layout.navbar-guest')
@section('content')
<div class="container mt-4">
    <div class="card">
        <!-- Add inline style or custom class to limit the image height -->
        <img src="{{ asset('storage/' . $article->image) }}" class="card-img-top img-fluid" alt="{{ $article->title }}" style="max-height: 300px; object-fit: cover;">
        <div class="card-body">
            <h5 class="card-title">{{ $article->title }}</h5>

            <!-- Display author's name and category -->
            <p class="card-text">
                <strong>Author:</strong> {{ $article->author }} <br>
                <strong>Category:</strong> {{ $article->category->name }}
            </p>

            <p class="card-text">{{ $article->content }}</p>
            <a href="{{ route('articles.index') }}" class="btn btn-primary">Kembali ke Daftar Artikel</a>
        </div>
    </div>
</div>
@endsection
@push('styles')
<link rel="stylesheet" href="{{ asset('style/article.css') }}">

@endpush
