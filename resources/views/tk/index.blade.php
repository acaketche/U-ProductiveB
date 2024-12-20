@extends('layout.navbar-guest')
@section('content')
<div class="container mt-4">
    <div class="row justify-content-center">
        <div class="col-12 col-md-8">
            <form action="{{ route('teknik_computer.index') }}" method="GET" class="d-flex flex-wrap justify-content-center gap-2">
                @auth
                    <button class="btn btn-primary" type="button" onclick="window.location.href='{{route('teknik_computer.create')}}';">
                        <i class="bi bi-plus me-2"></i>Tambah
                    </button>
                @else
                    <button class="btn btn-primary" type="button" onclick="window.location.href='{{ route('login') }}';">
                        <i class="bi bi-plus-lg me-1"></i>Tambah
                    </button>
                @endauth

                <div class="input-group" style="width: auto;">
                    <input type="text" name="search" class="form-control" placeholder="Cari Teknik Komputer" value="{{ request('search') }}">
                    <button class="btn btn-outline-secondary" type="submit">
                        <i class="bi bi-search"></i>
                    </button>
                </div>

                <div class="dropdown">
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
                                        @if($category->prodi_id === 3) <!-- Menampilkan kategori untuk prodi Komputer -->
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
                            <a href="{{ route('teknik_computer.index') }}" class="btn btn-link text-danger p-0">Bersihkan filter</a>
                            <div class="button-group">
                                <button type="button" class="btn btn-outline-secondary btn-sm me-2" data-bs-dismiss="dropdown">Batal</button>
                                <button type="submit" class="btn btn-primary btn-sm">Terapkan</button>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>

    @if(isset($teknik_computers) && $teknik_computers->count() > 0)
        <div class="row row-cols-1 row-cols-md-2 row-cols-lg-3 g-4 mt-4">
            @foreach ($teknik_computers as $teknik_computer)
            <div class="col-md-4 mb-4">
                <div class="card h-100 position-relative">
                    <a href="{{ route('teknik_computer.show', $teknik_computer->tk_id) }}">
                        <img data-pdf-thumbnail-file="{{ asset('storage/' . $teknik_computer->file_pdf) }}" data-pdf-thumbnail-width="500" width="350" height="300">
                    </a>
                    <h5 class="card-title" style="font-size: 14px; color: blue;">
                        {{ $teknik_computer->category->name }}
                    </h5>
                    <div class="card-body">
                        <h5 class="card-title">{{ $teknik_computer->title }}</h5>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    @else
        <div class="alert alert-info" role="alert">
            <i class="bi bi-info-circle me-2" >Tugas Akhir Yang Kamu Cari Tidak Ditemukan</i>
        </div>
    @endif

    <nav aria-label="Page navigation" class="mt-4">
        {{ $teknik_computers->links('pagination::bootstrap-5') }}
    </nav>
</div>
@endsection

@push('styles')
    <link href="{{asset('style/prodi.css')}}" rel="stylesheet">
@endpush

<script
    src="{{ asset('storage/pdfThumbnails.js') }}"
    data-pdfjs-src="https://cdnjs.cloudflare.com/ajax/libs/pdf.js/2.5.207/pdf.js">
</script>
