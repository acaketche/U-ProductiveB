@extends('layout.navbar-guest')

@section('content')
<div class="container mt-4">
    <div class="d-flex justify-content-center align-items-center mb-4">
        <button class="btn btn-primary me-2" onclick="window.location.href='{{route ('informatica.create')}}';">
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
                    <img src="{{ Storage::url($informatica->file_pdf) }}" class="card-img-top" alt="{{ $informatica->title }}">
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

@push('scripts')
<script src="https://mozilla.github.io/pdf.js/build/pdf.js"></script>

<script>
    // Path untuk library PDF.js
    var pdfjsLib = window['pdfjs-dist/build/pdf'];
    pdfjsLib.GlobalWorkerOptions.workerSrc = 'https://chrome.github.io/pdf.js/build/pdf.worker.js';


    // Fungsi untuk menampilkan thumbnail
    function renderPDF(url, canvasId) {
        var pdfUrl = '/path/to/pdf/' + pdfFile.file_pdfs;
        var loadingTask = pdfjsLib.getDocument(url);
        loadingTask.promise.then(function(pdf) {
            // Ambil halaman pertama PDF
            pdf.getPage(1).then(function(page) {
                var scale = 1.5;
                var viewport = page.getViewport({scale: scale});

                // Setup canvas untuk thumbnail
                var canvas = document.getElementById(canvasId);
                var context = canvas.getContext('2d');
                canvas.height = viewport.height;
                canvas.width = viewport.width;

                // Render halaman pertama PDF ke dalam canvas
                var renderContext = {
                    canvasContext: context,
                    viewport: viewport
                };
                page.render(renderContext);
            });
        });
    }

    // Panggil fungsi untuk setiap PDF
    @foreach($informatics as $informatica)
        renderPDF("{{ asset('storage/' . $informatica->file_pdf) }}", "pdf-thumbnail-{{ $informatica->if_id }}");
    @endforeach
</script>

@endpush

