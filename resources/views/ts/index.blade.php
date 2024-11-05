@extends('layout.navbar-guest')

@section('content')

<script src="{{ asset('js/pdf-thumbnail.js') }}"></script>

<div class="container mt-4">
    <div class="d-flex justify-content-center align-items-center mb-4">
        <button class="btn btn-primary me-2" onclick="window.location.href='{{ route('teknik_sipil.create') }}';">
            <i class="bi bi-plus me-2"></i>Tambah
        </button>
        <div class="d-flex">
            <!-- Form to handle search and filter -->
            <form action="{{ route('teknik_sipil.index') }}" method="GET" class="d-flex">
                <!-- Search input -->
                <input type="text" name="search" class="form-control me-2" placeholder="Cari Teknik Sipil" value="{{ request('search') }}">

                <!-- Filter Dropdown -->
                <div class="dropdown">
                    <button class="btn btn-outline-primary dropdown-toggle" type="button" id="filterDropdown" data-bs-toggle="dropdown" aria-expanded="false">
                        Filter
                    </button>
                    <div class="dropdown-menu p-3" style="width: 600px;">
                        <div class="row g-3">
                            <div class="col-6">
                                <label for="kategori" class="form-label">Kategori</label>
                                <select class="form-select" id="kategori" name="category">
                                    <option value="">Pilih</option>
                                    @foreach ($categories as $category)
                                        <option value="{{ $category->category_id }}" {{ request('category') == $category->category_id ? 'selected' : '' }}>
                                            {{ $category->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-6">
                                <label for="waktu" class="form-label">Waktu</label>
                                <select class="form-select" id="waktu" name="time">
                                    <option value="" {{ request('time') == '' ? 'selected' : '' }}>Semua Waktu</option>
                                    <option value="24 Jam" {{ request('time') == '24 Jam' ? 'selected' : '' }}>Dalam 24 Jam</option>
                                    <option value="1 Minggu" {{ request('time') == '1 Minggu' ? 'selected' : '' }}>1 Minggu Terakhir</option>
                                    <option value="1 Bulan" {{ request('time') == '1 Bulan' ? 'selected' : '' }}>1 Bulan Terakhir</option>
                                </select>
                            </div>
                        </div>
                        <div class="d-flex justify-content-between mt-3">
                            <!-- Clear filters button  -->
                            <a href="{{ route('teknik_sipil.index') }}" class="btn btn-link text-danger p-0">Bersihkan filter</a>
                            <div>
                                <button type="button" class="btn btn-outline-secondary btn-sm me-2" data-bs-dismiss="dropdown">Batal</button>
                                <!-- Apply filters button -->
                                <button type="submit" class="btn btn-primary btn-sm">Terapkan</button>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <div class="row">
        @foreach ($teknik_sipils as $teknik_sipil)
        <div class="col-md-4 mb-4">
            <div class="card h-100 position-relative">
                <!-- Gambar cover PDF -->
                <a href="{{ route('teknik_sipil.show', $teknik_sipil->ts_id) }}">
            <img src="{{ Storage::url($teknik_sipil->thumbnail_path) }}" class="card-img-top" {{ $teknik_sipil->title }}>
                </a>
                <div class="card-body">
                    <h5 class="card-title">{{ $teknik_sipil->title }}</h5>
                </div>
            </div>
        </div>
        @endforeach
    </div>

    <!-- Pagination -->
    <nav aria-label="Page navigation">
    {{ $teknik_sipils->links('pagination::bootstrap-5') }}
    </nav>
</div>
@endsection

@push('styles')
<link rel="stylesheet" href="{{ asset('style/teknik_sipil.css') }}">
@endpush

@push('scripts')
<!-- Tambahkan file JavaScript pdf-thumbnail.js -->
<script src="{{ asset('js/pdf-thumbnail.js') }}"></script>
<script>
    document.addEventListener("DOMContentLoaded", function() {
        // Pastikan fungsi dari pdf-thumbnail.js untuk menampilkan thumbnail PDF
        if (typeof generatePdfThumbnails === "function") {
            generatePdfThumbnails();
        }
    });
</script>
@endpush
