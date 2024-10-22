@extends('layout.navbar-guest')
@section('content')

    <!-- Form Tambah Tugas Akhir Baru -->
    <div class="container mt-4">
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('informatica.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="mb-3">
                <label for="judulArtikel" class="form-label">Judul Tugas Akhir</label>
                <input type="text" class="form-control" id="judulArtikel" name="title" placeholder="Masukkan Judul Artikel" required>
            </div>
            <div class="mb-3">
                <label for="kategoriArtikel" class="form-label">Kategori</label>
                <select name="category_id" class="form-select" required>
                    @foreach ($categories as $category)
                        <option value="{{ $category->category_id }}">{{ $category->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="mb-3">
                <label for="uploadFile" class="form-label">Upload File PDF</label>
                <input class="form-control" type="file" id="uploadFile" name="file_pdf" required>
            </div>
            <div class="d-flex justify-content-between">
                <a href="{{ route('informatica.index') }}" class="btn btn-secondary">&larr; Back</a>
                <button type="submit" class="btn btn-warning">Tambah Tugas Akhir</button>
            </div>
        </form>
    </div>
@endsection

