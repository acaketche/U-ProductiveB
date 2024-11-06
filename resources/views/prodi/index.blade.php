@extends('layout.navbar-guest')
@section('content')
<div class="container mt-4">
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <h2 class="text-center mb-4">Pilih Program Studi</h2>

                <div class="row">
                    <!-- Card Informatika -->
                    <div class="col-md-4 mb-4">
                        <div class="card h-100">
                            <div class="card-body text-center">
                                <h5 class="card-title">Informatika</h5>
                                <p class="card-text">Repository Tugas Akhir Program Studi Informatika</p>
                                <a href="{{ route('informatica.index', ['prodi_id' => 'Informatika']) }}"
                                   class="btn btn-primary">Lihat Tugas Akhir</a>
                            </div>
                        </div>
                    </div>

                    <!-- Card Teknik Sipil -->
                    <div class="col-md-4 mb-4">
                        <div class="card h-100">
                            <div class="card-body text-center">
                                <h5 class="card-title">Teknik Sipil</h5>
                                <p class="card-text">Repository Tugas Akhir Program Studi Teknik Sipil</p>
                                <a href="{{ route('prodi.show', ['prodi_id' => 'Teknik Sipil']) }}"
                                   class="btn btn-primary">Lihat Tugas Akhir</a>
                            </div>
                        </div>
                    </div>

                    <!-- Card Teknik Komputer -->
                    <div class="col-md-4 mb-4">
                        <div class="card h-100">
                            <div class="card-body text-center">
                                <h5 class="card-title">Teknik Komputer</h5>
                                <p class="card-text">Repository Tugas Akhir Program Studi Teknik Komputer</p>
                                <a href="{{ route('prodi.show', ['prodi_id' => 'Teknik Komputer']) }}"
                                   class="btn btn-primary">Lihat Tugas Akhir</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('styles')
<style>
    :root {
        --primary-color: #FFD166;
        --secondary-color: #af8585;
        --text-color: #000000;
        --background-color: #f8f9fa;
    }

    body {
        background-color: var(--background-color);
        color: var(--text-color);
    }

    .btn-primary {
        background-color: var(--primary-color);
        border: none;
        color: var(--text-color);
        font-weight: bold;
        transition: all 0.3s ease;
    }

    .btn-primary:hover {
        background-color: #ffc233;
        transform: translateY(-2px);
    }

    .btn-outline-primary {
        color: var(--secondary-color);
        border-color: var(--secondary-color);
    }

    .btn-outline-primary:hover {
        background-color: var(--secondary-color);
        color: white;
    }

    .card {
        border: none;
        border-radius: 15px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        transition: all 0.3s ease;
        overflow: hidden;
    }

    .card:hover {
        transform: translateY(-5px);
        box-shadow: 0 6px 12px rgba(0, 0, 0, 0.15);
    }

    .card-title {
        font-size: 1.2rem;
        font-weight: bold;
        color: var(--text-color);
    }

    .card-text {
        color: var(--text-color);
    }

    @media (max-width: 768px) {
        .col-md-4 {
            margin-bottom: 1rem;
        }
    }
</style>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.7.2/font/bootstrap-icons.css">
@endpush
