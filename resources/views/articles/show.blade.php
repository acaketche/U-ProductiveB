
@extends('layout.navbar-guest')

@section('content')
@php
    use Carbon\Carbon;
@endphp
<div class="container mt-4">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
            <li class="breadcrumb-item"><a href="{{ route('articles.index') }}">Articles</a></li>
            <li class="breadcrumb-item active" aria-current="page">{{ $article->title }}</li>
        </ol>
    </nav>

    <div class="card">
        <img src="{{ asset('storage/' . $article->image) }}" class="card-img-top img-fluid" alt="{{ $article->title }}" style="width: 70%; height: auto; display: block; margin: 0 auto;">
        <div class="card-body">
            <h1 class="card-title">{{ $article->title }}</h1>
            <p class="card-text">
                <strong>Author:</strong> {{ $article->author }} <br>
                <strong>Category:</strong> {{ $article->category->name }} <br>
                <strong>Published on:</strong> {{ Carbon::parse($article->created_at)->format('F j, Y') }}
            </p>
            <p class="card-text">{{ $article->content }}</p>
            <div class="card-footer">
                <small>Last updated on {{ Carbon::parse($article->updated_at)->format('F j, Y') }}</small>
            </div>
    </div>
</div>
@endsection


@push('styles')
<link rel="stylesheet" href="{{ asset('style/article.css') }}">
@endpush
