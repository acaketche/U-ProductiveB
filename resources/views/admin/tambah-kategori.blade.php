@extends('layout.navbar-admin')
@section('judul', 'Kelola Kategori')
@section('content')
<main class="col-md-9 ms-sm-auto col-lg-10 px-md-3" style="padding-left: 20px;">
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Tambah Kategori</h1>
    </div>

    <div class="content">
        <form action="{{ route('kategori.store') }}" method="POST">
            @csrf
            <div class="mb-3">
                <label for="name" class="form-label">Nama Kategori</label>
                <input type="text" class="form-control" id="name" name="name" placeholder="Masukkan nama kategori" required>
            </div>
            <div class="mb-3">
                <label for="prodi_id" class="form-label">Pilih Prodi</label>
                <select class="form-select" id="prodi_id" name="prodi_id">
                    <option value="">Tanpa Prodi</option>
                    @foreach($prodis as $prodi)
                        <option value="{{ $prodi->prodi_id }}">{{ $prodi->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="d-flex">
                <button type="submit" class="btn btn-primary me-2">Simpan</button>
                <a href="{{ route('kelola.kategori') }}" class="btn btn-secondary">Kembali</a>
            </div>
        </form>
    </div>
</main>
@endsection

@section('scripts')
<script>
    feather.replace();
</script>
@endsection
