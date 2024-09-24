@extends('layout.navbar-admin')
@section('judul','Dashboard')
@section('judul2','Dashboard')
@section('content')

                <!-- Content Row -->
                <div class="row">
                    <div class="col-12 col-md-6 col-lg-4 mb-4">
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title">Kelola Data User</h5>
                                <p class="card-text">Manajemen data pengguna yang terdaftar di sistem.</p>
                                <a href="{{ route('kelola.user') }}" class="btn btn-primary">Kelola User</a>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-md-6 col-lg-4 mb-4">
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title">Kelola Data Kategori</h5>
                                <p class="card-text">Manajemen kategori untuk artikel dan video.</p>
                                <a href="{{ route('kelola.kategori') }}" class="btn btn-primary">Kelola Kategori</a>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-md-6 col-lg-4 mb-4">
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title">Kelola Data Artikel</h5>
                                <p class="card-text">Manajemen artikel yang diterbitkan di platform.</p>
                                <a href="{{ route('kelola.artikel') }}" class="btn btn-primary">Kelola Artikel</a>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Additional Content Row -->
                <div class="row">
                    <div class="col-12 col-md-6 col-lg-4 mb-4">
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title">Kelola Data Video</h5>
                                <p class="card-text">Manajemen video yang diterbitkan di platform.</p>
                                <a href="{{ route('kelola.video') }}" class="btn btn-primary">Kelola Video</a>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-md-6 col-lg-4 mb-4">
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title">Kelola Forum</h5>
                                <p class="card-text">Manajemen forum diskusi untuk pengguna.</p>
                                <a href="{{ route('kelola.forum') }}" class="btn btn-primary">Kelola Forum</a>
                            </div>
                        </div>
                    </div>
                </div>
            </main>
        </div>
    </div>

@endsection


