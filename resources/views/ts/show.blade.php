@extends('layout.navbar-guest')

@section('content')
@php
    use Carbon\Carbon;
@endphp
<div class="container mt-4">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
            <li class="breadcrumb-item"><a href="{{ route('teknik_sipil.index') }}">Teknik Sipil</a></li>
            <li class="breadcrumb-item active" aria-current="page">{{ $teknik_sipils->title }}</li>
        </ol>
    </nav>
    <div class="card">
        <iframe src="{{ Storage::url($teknik_sipils->file_pdf) }}" width="100%" height="600px">
            Your browser does not support PDFs.
            <a href="{{ Storage::url($teknik_sipils->file_pdf) }}">Download the PDF</a>
        </iframe>        <div class="card-body">
            <h1 class="card-title">{{ $teknik_sipils->title }}</h1>
            <p class="card-text">
                <strong>Author:</strong> {{ $teknik_sipils->user->name }} <br>
                <strong>Category:</strong> {{ $teknik_sipils->category->name }} <br>
                <strong>Published on:</strong> {{ Carbon::parse($teknik_sipils->created_at)->format('F j, Y') }}
            </p>
            <p class="card-text">{{ $teknik_sipils->content }}</p>
            <div class="card-footer">
                <small>Last updated on {{ Carbon::parse($teknik_sipils->updated_at)->format('F j, Y') }}</small>
            </div>
    </div>
</div>
@endsection

@push('styles')
<link rel="stylesheet" href="{{ asset('style/article.css') }}">
@endpush
