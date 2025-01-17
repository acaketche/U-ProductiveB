@extends('layout.navbar-admin')
@section('judul', 'Kelola Kategori')

@section('content')
<main class="col-md-9 ms-sm-auto col-lg-10 px-md-3">
    <!-- Page Title -->
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom" style="margin-left: -150px;">
        <h1 class="h2">Tambah Kategori</h1>
    </div>

    <!-- Form Tambah Kategori -->
    <div class="content">
        <div class="card" style="margin-left: -150px;"> <!-- Geser card ke kiri -->
            <div class="card-body">
                <form action="{{ route('kategori.store') }}" method="POST">
                    @csrf
                    <!-- Input Nama Kategori -->
                    <div class="mb-3">
                        <label for="name" class="form-label">Nama Kategori</label>
                        <input
                            type="text"
                            class="form-control @error('name') is-invalid @enderror"
                            id="name"
                            name="name"
                            placeholder="Masukkan nama kategori"
                            value="{{ old('name') }}"
                            required>
                        @error('name')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Pilih Prodi -->
                    <div class="mb-3">
                        <label for="prodi_id" class="form-label">Pilih Prodi</label>
                        <select
                            class="form-select @error('prodi_id') is-invalid @enderror"
                            id="prodi_id"
                            name="prodi_id">
                            <option value="">Tanpa Prodi</option>
                            @foreach($prodis as $prodi)
                                <option value="{{ $prodi->prodi_id }}" {{ old('prodi_id') == $prodi->prodi_id ? 'selected' : '' }}>
                                    {{ $prodi->name }}
                                </option>
                            @endforeach
                        </select>
                        @error('prodi_id')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Buttons -->
                    <div class="d-flex justify-content-end">
                        <button type="submit" class="btn btn-primary me-2">
                            <i class="bi bi-check-circle"></i> Simpan
                        </button>
                        <a href="{{ route('kelola.kategori') }}" class="btn btn-secondary">
                            <i class="bi bi-arrow-left"></i> Kembali
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</main>
@endsection

@section('scripts')
<script>
    feather.replace();
</script>
@endsection
