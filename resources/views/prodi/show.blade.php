@extends('layout.navbar-guest')
@section('content')
    <div class="container mt-5">
        <div class="row mb-4">
            <div class="col">
                <a href="{{ route('prodi.index') }}" class="btn btn-secondary">← Kembali</a>
            </div>
        </div>

        <div class="row">
            <div class="col">
                <h2>Repository Tugas Akhir - {{ $prodi->prodi_id }}</h2>
            </div>
        </div>

        <div class="row mt-4">
            <div class="col">
                <!-- Search Form -->
                <form action="{{ route('prodi.show', $prodi->prodi_id) }}" method="GET" class="mb-4">
                    <div class="input-group">
                        <input type="text" name="search" class="form-control"
                               placeholder="Cari judul tugas akhir..."
                               value="{{ request('search') }}">
                        <button class="btn btn-primary" type="submit">Cari</button>
                    </div>
                </form>

                <!-- Table of Thesis -->
                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>Judul</th>
                                <th>Kategori</th>
                                <th>Tanggal Upload</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($theses as $thesis)
                            <tr>
                                <td>{{ $thesis->title }}</td>
                                <td>{{ $thesis->category->name ?? '-' }}</td>
                                <td>{{ $thesis->create_at->format('d M Y') }}</td>
                                <td>
                                    <div class="btn-group">
                                        @if($thesis->file_pdf)
                                        <a href="{{ Storage::url($thesis->file_pdf) }}"
                                           class="btn btn-sm btn-success"
                                           target="_blank">
                                            Lihat PDF
                                        </a>
                                        @endif

                                        @if($thesis->thumbnail)
                                        <a href="{{ Storage::url($thesis->thumbnail) }}"
                                           class="btn btn-sm btn-info ms-1"
                                           target="_blank">
                                            Lihat Thumbnail
                                        </a>
                                        @endif
                                    </div>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="4" class="text-center">Tidak ada data tugas akhir</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                <!-- Pagination -->
                <div class="d-flex justify-content-center">
                    {{ $theses->links() }}
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

        .dropdown-menu {
        width: 350px; /* Atur lebar dropdown agar lebih besar */
        padding: 15px; /* Menambah padding dalam dropdown */
        box-shadow: 0 0.5rem 1rem rgba(0, 0, 0, 0.15);
        border: none;
        border-radius: 10px;
    }

        .form-label {
            font-weight: bold;
            font-size: 1rem; /* Perbesar teks label */
        }

        .form-select {
            font-size: 1rem; /* Perbesar ukuran teks dalam select */
            padding: 0.75rem; /* Tambah padding pada dropdown option */
        }

        .dropdown-toggle {
            font-size: 1rem; /* Perbesar ukuran teks tombol dropdown */
            padding: 0.5rem 1rem; /* Sesuaikan padding pada tombol dropdown */
        }

        .dropdown-menu .btn-sm {
            padding: 0.5rem 1rem; /* Sesuaikan ukuran tombol kecil */
            font-size: 0.875rem; /* Sesuaikan ukuran font tombol kecil */
        }

        .article-card {
            border: none;
            border-radius: 15px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            transition: all 0.3s ease;
            overflow: hidden;
        }

        .article-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 6px 12px rgba(0, 0, 0, 0.15);
        }

        .card-img-top {
            border-top-left-radius: 15px;
            border-top-right-radius: 15px;
            object-fit: cover;
            height: 200px;
            transition: all 0.3s ease;
        }

        .card-img-link:hover .card-img-top {
            transform: scale(1.05);
        }

        .card-title {
            font-size: 1.2rem;
            font-weight: bold;
            color: var(--text-color);
        }

        .card-text {
            color: var(--text-color);
        }

        .pagination .page-link {
            color: var(--text-color);
            border: none;
            margin: 0 2px;
            border-radius: 5px;
        }

        .pagination .page-link:hover,
        .pagination .page-item.active .page-link {
            background-color: var(--primary-color);
            color: var(--text-color);
        }

        @media (max-width: 768px) {
            .dropdown-menu {
                width: 100% !important;
            }
            .row > .col-6 {
                width: 100%;
            }
        }
    </style>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.7.2/font/bootstrap-icons.css">
    @endpush
