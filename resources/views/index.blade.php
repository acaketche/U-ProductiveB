@extends('layout.navbar-guest')
@section('content')
<div class="video-background">
    <video autoplay muted loop id="background-video">
        <source src="{{ asset('storage/video/videoopening.mp4') }}" type="video/mp4">
        Your browser does not support the video tag.
    </video>
    <div class="content-wrapper">
        <div class="video-overlay">
            <h1 class="display-4 font-weight-bold text-white">WELCOME TO U-PRODUCTIVE</h1>
            <p class="lead text-white">Master Your university Life</p>
            <a href="{{ route('login') }}" class="btn btn-lg btn-primary-soft">Want To Join Us?</a>
        </div>
    </div>
</div>
@endsection

@push('styles')
<style>
    body, html {
        margin: 0;
        padding: 0;
        overflow: hidden;
        width: 100%;
        height: 100%;
    }

    .video-background {
        position: relative;
        width: 100%;
        height: 100vh;
        overflow: hidden;
    }

    #background-video {
        position: absolute;
        top: 50%;
        left: 50%;
        min-width: 100%;
        min-height: 100%;
        width: auto;
        height: auto;
        transform: translate(-50%, -50%);
        z-index: 0;
    }

    .content-wrapper {
        position: relative;
        width: 100%;
        height: 100vh;
        display: flex;
        align-items: center;
        justify-content: center;
        z-index: 2;
        margin-top: -100px; /* Menambahkan margin negatif untuk menggeser ke atas */
    }

    .video-overlay {
        text-align: center;
        padding: 20px;
        /* background-color: rgba(0, 0, 0, 0.3); */
        border-radius: 10px;
    }

    .btn-primary-soft {
        background-color: #5b9aec;
        color: #fff;
        border: none;
        position: relative;
        z-index: 3;
        cursor: pointer;
        transition: background-color 0.3s ease;
    }

    .btn-primary-soft:hover {
        background-color: #5b8dcc;
        color: #fff;
        text-decoration: none;
    }
</style>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
@endpush
