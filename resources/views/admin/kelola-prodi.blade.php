@extends('layout.navbar-admin')
@section('judul','Dashboard')
@section('judul2','Dashboard')
@section('content')
<h1>Kelola Data Tugas Akhir Prodi</h1>
                <!-- Content Row -->
                <div class="row">
                    <div class="col-12 col-md-6 col-lg-4 mb-4">
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title">Prodi Informatika</h5>
                                <p class="card-text">Manajeman Data Tugas Akhir Mahasiswa Prodi Informatika</p>
                                <a href="{{route('kelola.informatika')}}" class="btn btn-primary">Informatika</a>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-md-6 col-lg-4 mb-4">
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title">Prodi Teknik Sipil</h5>
                                <p class="card-text">Manajeman Data Tugas Akhir Mahasiswa Prodi Teknik Sipil</p>
                                <a href="#" class="btn btn-primary">Teknik Sipil</a>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-md-6 col-lg-4 mb-4">
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title">Prodi Teknik Komputer</h5>
                                <p class="card-text">Manajeman Data Tugas Akhir Mahasiswa Prodi Teknik Komputer</p>
                                <a href="#" class="btn btn-primary">Teknik Komputer</a>
                            </div>
                        </div>
                    </div>
                </div>

            </main>
        </div>
    </div>

@endsection


