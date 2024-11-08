@extends('layout.navbar-guest')
@section('content')
    <!-- Sidebar -->
    <div class="sidebar">
        <img src="{{ Auth::user() && Auth::user()->profile_picture ? Storage::url(Auth::user()->profile_picture) : asset('images/default-profile.png') }}" >
        <div class="profile-info">
            @if (Auth::check())
                <p>{{ Auth::user()->name }}</p>
                <p class="contact-info">{{ Auth::user()->email }}</p>
                <p class="contact-info">{{ Auth::user()->role }}</p>
            @else
                <p>Guest</p>
                <p class="contact-info">Email tidak tersedia</p>
            @endif
        </div>
        <div class="menu">
            <a href="{{route('user.profile')}}"><i class="bi bi-person-circle"></i> Profile</a>
            <a href="#"  class="active"><i class="bi bi-clock-history"></i> History</a>
            <a href="{{route('favorite.index')}}"><i class="bi bi-star-fill"></i> Favorite</a>
        </div>
    </div>
    <!-- Content -->
    <div class="container mt-4" style="max-width: 800px; margin: auto;">
        <h3 class="mb-4">History</h3>
        <div class="row">
            <!-- Unified Card for History -->
            <div class="col-12 mb-3">
                <div class="card shadow-sm">
                    <div class="card-body">
                        <h5 class="card-title">Riwayat Kunjungan</h5>
                        @if(count($histories) > 0)
                            @foreach($histories as $history)
                                <div class="history-item mb-3">
                                    @if($history->article)
                                        <div class="history-type">
                                            <i class="bi bi-file-text"></i>
                                            <span>Artikel</span>
                                        </div>
                                        <a href="{{ route('articles.show', $history->article->article_id) }}">
                                            <h6>{{ $history->article->title ?? 'Judul tidak tersedia' }}</h6>
                                        </a>
                                    @elseif($history->video)
                                        <div class="history-type">
                                            <i class="bi bi-play-circle"></i>
                                            <span>Video</span>
                                        </div>
                                        <a href="{{ route('video.show', $history->video->video_id) }}">
                                            <h6>{{ $history->video->title ?? 'Judul tidak tersedia' }}</h6>
                                        </a>
                                    @elseif($history->informatics)
                                        <div class="history-type">
                                            <i class="bi bi-laptop"></i>
                                            <span>Informatika</span>
                                        </div>
                                        <a href="{{ route('informatica.show', $history->informatics->if_id) }}">
                                            <h6>{{ $history->informatics->title ?? 'Judul tidak tersedia' }}</h6>
                                        </a>
                                    @elseif($history->teknik_sipils)
                                        <div class="history-type">
                                            <i class="bi bi-building"></i>
                                            <span>Teknik Sipil</span>
                                        </div>
                                        <a href="{{ route('teknik_sipil.show', $history->teknik_sipils->ts_id) }}">
                                            <h6>{{ $history->teknik_sipils->title ?? 'Judul tidak tersedia' }}</h6>
                                        </a>
                                    @elseif($history->teknik_computers)
                                        <div class="history-type">
                                            <i class="bi bi-cpu"></i>
                                            <span>Teknik Komputer</span>
                                        </div>
                                        <a href="{{ route('teknik_computer.show', $history->teknik_computers->tk_id) }}">
                                            <h6>{{ $history->teknik_computers->title ?? 'Judul tidak tersedia' }}</h6>
                                        </a>
                                    @endif
                                    <p class="text-muted small mb-0">
                                        {{ $history->viewed_at ? \Carbon\Carbon::parse($history->viewed_at)->timezone('Asia/Jakarta')->format('d M Y, H:i') : 'Tanggal tidak tersedia' }}
                                    </p>
                                </div>
                            @endforeach
                        @else
                            <p>Tidak ada riwayat kunjungan.</p>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('styles')
    <link href="{{asset('style/history.css')}}" rel="stylesheet">
@endpush
