@extends('layout.navbar-guest')
@section('content')
<div class="container mt-4">
    <div class="row justify-content-center mb-4">
        <div class="col-md-10">
            <div class="d-flex justify-content-center align-items-center flex-wrap">
                <form action="{{ route('teknik_sipil.index') }}" method="GET" class="d-flex flex-grow-1 flex-wrap justify-content-center align-items-center">
                    @auth
                    <button class="btn btn-primary me-2 mb-2 mb-md-0" type="button"
                        onclick="window.location.href='{{ route('teknik_sipil.create') }}';">
                        <i class="bi bi-plus-lg me-1"></i>Tambah
                    </button>
                    @else
                    <button class="btn btn-primary me-2 mb-2 mb-md-0" type="button"
                        onclick="window.location.href='{{ route('login') }}';">
                        <i class="bi bi-plus-lg me-1"></i>Tambah
                    </button>
                    @endauth
                    <div class="input-group me-2 mb-2 mb-md-0 flex-grow-1" style="max-width: 300px;">
                        <input type="text" name="search" class="form-control" placeholder="Cari Teknik Sipil" value="{{ request('search') }}">
                        <button class="btn btn-outline-secondary" type="submit">
                            <i class="bi bi-search"></i>
                        </button>
                    </div>
                    <div class="dropdown mb-2 mb-md-0">
                        <button class="btn btn-outline-primary dropdown-toggle" type="button" id="filterDropdown" data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="bi bi-funnel me-1"></i>Filter
                        </button>
                        <div class="dropdown-menu p-3">
                            <div class="row g-3">
                                <div class="col-md-6">
                                    <label for="kategori" class="form-label">Kategori</label>
                                    <select class="form-select" id="kategori" name="category">
                                        <option value="">Pilih</option>
                                        @foreach ($categories as $category)
                                        @if($category->prodi_id === 2) <!-- Menampilkan kategori untuk prodi Komputer -->
                                            <option value="{{ $category->category_id }}" {{ request('category') == $category->category_id ? 'selected' : '' }}>
                                                {{ $category->name }}
                                            </option>
                                        @endif
                                    @endforeach
                                    </select>
                                </div>
                                <div class="col-md-6">
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
                                <a href="{{ route('teknik_sipil.index') }}" class="btn btn-link text-danger p-0">Bersihkan filter</a>
                                <div>
                                    <button type="button" class="btn btn-outline-secondary btn-sm me-2" data-bs-dismiss="dropdown">Batal</button>
                                    <button type="submit" class="btn btn-primary btn-sm">Terapkan</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="row row-cols-1 row-cols-md-2 row-cols-lg-3 g-4">
        @foreach ($teknik_sipils as $teknik_sipil)
        <div class="col">
            <div class="card h-100 article-card">
                <a href="{{ route('teknik_sipil.show', $teknik_sipil->ts_id) }}" class="card-img-link">
                    <img data-pdf-thumbnail-file="{{asset('storage/'. $teknik_sipil->file_pdf)}}" data-pdf-thumbnail-width="500" width="350" height="300">
                </a>
                <h5 class="card-title" style="font-size: 14px; color: blue;">
                    {{ $teknik_sipil->category->name }}
                </h5>
                <div class="card-body">
                    <h5 class="card-title">{{ $teknik_sipil->title }}</h5>
                </div>
            </div>
        </div>
        @endforeach
    </div>

    <nav aria-label="Page navigation" class="mt-4">
        {{ $teknik_sipils->links('pagination::bootstrap-5') }}
    </nav>
</div>
@endsection

@push('styles')
    <link href="{{asset('style/prodi.css')}}" rel="stylesheet">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.7.2/font/bootstrap-icons.css">
@endpush

<script
    src="{{ asset('storage/pdfThumbnails.js') }}"
    data-pdfjs-src="https://cdnjs.cloudflare.com/ajax/libs/pdf.js/2.5.207/pdf.js">
</script>
