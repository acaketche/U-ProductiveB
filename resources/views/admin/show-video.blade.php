@extends('layout.navbar-admin')
@section('judul','Kelola Artikel')
@section('judul2','Kelola Artikel')
@section('content')
@php
    use Carbon\Carbon;
@endphp
<div class="content">
    <h3>{{ $video->title }}</h3>
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('kelola.video') }}">Kelola Video</a></li> 
        </ol>
    </nav>

    <div class="row">
        <!-- Kolom Video dan Judul -->
        <div class="col-md-8">
            <div class="ratio ratio-16x9">
                <!-- Ganti dengan video ID dinamis -->
                <iframe src="https://www.youtube.com/embed/{{ $videoId }}" frameborder="0" allowfullscreen allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"></iframe>
            </div>
            <h3 class="mt-3">{{ $video->title }}</h3> <!-- Judul di bawah video -->
        </div>

        <!-- Kolom Deskripsi dan Kategori -->
        <div class="col-md-4">
            <p><strong>Sender:</strong> {{ $video->user->name }}</p>
            <p><strong>Kategori:</strong> {{ $video->category->name }}</p>
            <p><strong>Deskripsi:</strong> {{ $video->description }}</p>
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

