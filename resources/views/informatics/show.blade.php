@extends('layout.navbar-guest')

@section('content')
@php
    use Carbon\Carbon;
@endphp
<div class="container mt-4">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
            <li class="breadcrumb-item"><a href="{{ route('informatica.index') }}">Informatics</a></li>
            <li class="breadcrumb-item active" aria-current="page">{{ $informatics->title }}</li>
        </ol>
    </nav>

    <div class="card">
        <iframe src="{{ Storage::url($informatics->file_pdf) }}" width="100%" height="600px">
            Your browser does not support PDFs.
            <a href="{{ Storage::url($informatics->file_pdf) }}">Download the PDF</a>
        </iframe>
        <div class="card-body">
            <h1 class="card-title">{{ $informatics->title }}</h1>
            <p class="card-text">
                <strong>Author:</strong> {{ $informatics->user }} <br>
                <strong>Category:</strong> {{ $informatics->category->name }} <br>
                <strong>Published on:</strong> {{ Carbon::parse($informatics->created_at)->format('F j, Y') }}
            </p>
            <p class="card-text">{{ $informatics->content }}</p>
            <div class="card-footer">
                <small>Last updated on {{ Carbon::parse($informatics->updated_at)->format('F j, Y') }}</small>
            </div>
    </div>
</div>
@endsection

@push('styles')
<link rel="stylesheet" href="{{ asset('style/article.css') }}">
@endpush

@push('scripts')
<script>
// Render thumbnail PDF jika ada
var pdfUrl = "{{ asset('storage/' . $informatics->file_pdf) }}";
renderPDF(pdfUrl, "pdf-thumbnail");
</script>
@endpush
