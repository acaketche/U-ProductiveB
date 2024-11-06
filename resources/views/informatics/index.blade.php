@extends('layout.navbar-guest')

@section('content')
<div class="container mt-4">
    <div class="d-flex justify-content-center align-items-center mb-4">
        <button class="btn btn-primary me-2" onclick="window.location.href='{{route('informatica.create')}}';">
            <i class="bi bi-plus me-2"></i>Tambah
        </button>
        <div class="d-flex">
            <!-- Form untuk pencarian dan filter -->
            <form action="{{ route('informatica.index') }}" method="GET" class="d-flex">
                <!-- Input pencarian -->
                <input type="text" name="search" class="form-control me-2" placeholder="Cari Informatika" value="{{ request('search') }}">

                <!-- Dropdown Filter -->
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
                            <!-- Tombol untuk membersihkan filter -->
                            <a href="{{ route('informatica.index') }}" class="btn btn-link text-danger p-0">Bersihkan filter</a>
                            <div>
                                <button type="button" class="btn btn-outline-secondary btn-sm me-2" data-bs-dismiss="dropdown">Batal</button>
                                <!-- Tombol untuk menerapkan filter -->
                                <button type="submit" class="btn btn-primary btn-sm">Terapkan</button>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <div class="row">
        @foreach ($informatics as $informatica)
        <div class="col-md-4 mb-4">
            <div class="card h-100 position-relative">
                <!-- Gambar dengan tautan -->
                <a href="{{ route('informatica.show', $informatica->if_id) }}">
                    <img data-pdf-thumbnail-file="{{ asset('storage/' . $informatica->file_pdf) }}" data-pdf-thumbnail-width="500" width="350" height="300">
                </a>
                <div class="card-body">
                    <h5 class="card-title">{{ $informatica->title }}</h5>
                </div>
            </div>
        </div>
        @endforeach
    </div>

    <!-- Pagination -->
    <nav aria-label="Page navigation">
        {{ $informatics->links('pagination::bootstrap-5') }}
    </nav>
</div>

@endsection

@push('styles')
<link rel="stylesheet" href="{{ asset('style/informatica.css') }}">
@endpush

<script
    src="{{asset('storage/pdfThumbnails.js')}}"
    data-pdfjs-src="https://cdnjs.cloudflare.com/ajax/libs/pdf.js/2.5.207/pdf.js">
</script>

