@extends('layout.navbar-guest')
@section('content')
<div class="container mt-4">
    <h1 class="mb-4">Tambah Video Baru</h1>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('video.store') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label for="title" class="form-label">Judul Video</label>
            <input type="text" class="form-control" id="title" name="title" value="{{ old('title') }}" required>
        </div>
        <div class="mb-3">
            <label for="url" class="form-label">URL Video</label>
            <input type="url" class="form-control" id="url" name="url" value="{{ old('url') }}" required>
        </div>
        <div class="mb-3">
            <label for="category_id" class="form-label">Kategori</label>
            <select name="category_id" id="category_id" class="form-select" required>
                <option value="">Pilih Kategori</option>
                @foreach ($categories as $category)
                    <option value="{{ $category->category_id }}">{{ $category->name }}</option>
                @endforeach
            </select>
        </div>
        <div class="mb-3">
            <label for="description" class="form-label">Deskripsi</label>
            <textarea class="form-control" id="description" name="description" rows="3">{{ old('description') }}</textarea>
        </div>
        <button type="submit" class="btn btn-primary">Simpan</button>
        <a href="{{ route('video.index') }}" class="btn btn-outline-secondary">Kembali</a>
    </form>
</div>

@endsection

