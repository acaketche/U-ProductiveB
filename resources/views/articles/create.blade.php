@extends('layout.navbar-guest')
@section('content')

    <!-- Form Tambah Artikel Baru -->
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

        <form action="{{ route('articles.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="mb-3">
                <label for="judulArtikel" class="form-label">Judul Artikel</label>
                <input type="text" class="form-control" id="judulArtikel" name="title" placeholder="Masukkan Judul Artikel" required>
            </div>
            <div class="mb-3">
                <label for="kategoriArtikel" class="form-label">Kategori Artikel</label>
                <select name="category_id" class="form-select" required>
                    @foreach ($categories as $category)
                                            @if($category->prodi_id === null)
                                                <option value="{{ $category->category_id }}" {{ request('category') == $category->category_id ? 'selected' : '' }}>
                                                    {{ $category->name }}
                                                </option>
                                            @endif
                                        @endforeach
                </select>
            </div>
            <div class="mb-3">
                <label for="isiArtikel" class="form-label">Isi Artikel</label>
                <textarea class="form-control" id="isiArtikel" name="content" rows="5" placeholder="Tulis isi artikel di sini" required></textarea>
            </div>
            <div class="mb-3">
                <label for="uploadImage" class="form-label">Upload Gambar</label>
                <input class="form-control" type="file" id="uploadImage" name="image" required>
            </div>
            <div class="d-flex justify-content-between">
                <a href="{{ route('articles.index') }}" class="btn btn-secondary">&larr; Back</a>
                <button type="submit" class="btn btn-warning">Tambah Artikel</button>
            </div>
        </form>
    </div>
@endsection
