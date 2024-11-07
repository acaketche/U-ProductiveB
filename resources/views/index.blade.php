@extends('layout.navbar-guest')
@section('content')

<div class="video-background">
    <video autoplay muted loop id="background-video">
        <source src="{{ asset('storage/video/videoopening.mp4') }}" type="video/mp4">
        Your browser does not support the video tag.
    </video>
    <div class="video-overlay">
        <h1 class="display-4 font-weight-bold text-white">WELCOME TO U-PRODUCTIVITY</h1>
        <p class="lead text-white">Master Your university Life</p>
        <a href="{{ route('login') }}" class="btn btn-lg btn-primary-soft">Want To Join Us?</a>
    </div>
</div>

@endsection

@push('styles')
<style>
    /* Remove body margin and padding to prevent any unwanted scrolling */
    body, html {
        margin: 0;
        padding: 0;
        overflow: hidden; /* Prevent scrolling */
        width: 100%;
        height: 100%;
    }

    /* Fullscreen Video Background */
    .video-background {
        position: fixed; /* Fixed positioning to cover viewport */
        top: 0;
        left: 0;
        width: 100%;
        height: 100vh; /* Full viewport height */
        overflow: hidden;
        display: flex;
        align-items: center;
        justify-content: center;
        z-index: -1;
    }

    #background-video {
        position: absolute;
        top: 50%;
        left: 50%;
        width: 100vw;
        height: 100vh;
        object-fit: cover;
        transform: translate(-50%, -50%);
    }

    /* Video Overlay Text */
    .video-overlay {
        position: relative;
        z-index: 1;
        color: #fff;
        text-align: center;
        /* background-color: rgba(0, 0, 0, 0.5); Dark overlay for readability */
        padding: 20px;
        font-weight: bold;
    }

    /* Custom class for a softer button */
.btn-primary-soft {
    background-color: #5b9aec; /* Softer blue color */
    color: #fff;
    border: none;
}

.btn-primary-soft:hover {
    background-color: #5b8dcc; /* Slightly darker shade for hover effect */
}

</style>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
@endpush
