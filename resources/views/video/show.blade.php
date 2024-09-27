@extends('layout.navbar-guest')

@section('content')
<div class="container mt-4">
    <!-- Tombol kembali -->
    <div class="mb-4">
        <a href="{{ route('video.index') }}" class="btn btn-outline-secondary">
            <i class="bi bi-arrow-left"></i> Kembali
        </a>
    </div>

    <div class="row">
        <!-- Kolom Video dan Judul -->
        <div class="col-md-8">
            <div class="ratio ratio-16x9">
                <!-- Ganti dengan video ID dinamis -->
                <iframe src="https://www.youtube.com/embed/{{ $video_Id }}" frameborder="0" allowfullscreen allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"></iframe>
            </div>
            <h3 class="mt-3">{{ $video->title }}</h3> <!-- Judul di bawah video -->
        </div>

        <!-- Kolom Deskripsi dan Kategori -->
        <div class="col-md-4">
            <p><strong>Kategori:</strong> {{ $video->category->name }}</p>
            <p><strong>Deskripsi:</strong> {{ $video->description }}</p>
        </div>
    </div>
</div>
@endsection
