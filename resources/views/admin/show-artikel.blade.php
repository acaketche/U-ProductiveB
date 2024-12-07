@extends('layout.navbar-admin')
@section('judul','Kelola Artikel')
@section('judul2','Kelola Artikel')
@section('content')
@php
    use Carbon\Carbon;
@endphp
<div class="content">
    <h3>{{ $article->title }}</h3>
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('kelola.artikel') }}">Kelola Artikel</a></li> 
        </ol>
    </nav>

    <div class="card">
        <img src="{{ asset('storage/' . $article->image) }}" class="card-img-top img-fluid" alt="{{ $article->title }}" style="width: 70%; height: auto; display: block; margin: 0 auto;">
        <div class="card-body">
            <h1 class="card-title">{{ $article->title }}</h1>
            <p class="card-text">
                <strong>Author:</strong> {{ $article->user->name }} <br>
                <strong>Category:</strong> {{ $article->category->name }} <br>
                <strong>Published on:</strong> {{ Carbon::parse($article->created_at)->format('F j, Y') }}
            </p>
            <div class="card-text">
                {!! nl2br(e($article->content)) !!}
            </div>
            <div class="card-footer">
                <small>Last updated on {{ Carbon::parse($article->updated_at)->format('F j, Y') }}</small>
            </div>
        </div>
    </div>
</div>
@endsection

@push('styles')
<style>
    .table th {
        background-color: #f8f9fa;
    }
    .badge {
        font-size: 0.875rem;
    }
    .action-buttons {
        white-space: nowrap;
    }
    .pagination {
        margin: 0;
    }
    .pagination .page-link {
        padding: 0.5rem 0.75rem;
        margin: 0 2px;
        border-radius: 4px;
    }
    .card {
        box-shadow: 0 0 10px rgba(0,0,0,.1);
    }
</style>
@endpush

