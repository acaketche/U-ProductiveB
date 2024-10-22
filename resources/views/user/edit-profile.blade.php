@extends('layout.navbar-user')

@section('judul', 'Edit Profile')

@section('content')
<div class="container mt-4">
    <h1>Edit Profile</h1>

    <!-- Menampilkan pesan sukses atau error -->
    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    @if($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('profile.update') }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <!-- Input Nama -->
        <div class="mb-3">
            <label for="name" class="form-label">Name</label>
            <input type="text" name="name" id="name" class="form-control" value="{{ old('name', $user->name) }}" required>
        </div>

        <!-- Input Email -->
        <div class="mb-3">
            <label for="email" class="form-label">Email</label>
            <input type="email" name="email" id="email" class="form-control" value="{{ old('email', $user->email) }}" required>
        </div>

        <!-- Input Password Lama -->
        <div class="mb-3">
            <label for="current_password" class="form-label">Password Lama</label>
            <input type="password" name="current_password" id="current_password" class="form-control" required>
            <small class="form-text text-muted">Masukkan password saat ini sebelum mengubah password baru.</small>

            <label for="password" class="form-label">Password</label>
            <input type="password" name="password" id="password" class="form-control">
            <small class="form-text text-muted">Kosongkan jika tidak ingin mengubah password.</small>
        </div>

        <!-- Input Foto Profil -->
        <div class="mb-3">
            <label for="profile_picture" class="form-label">Profile Photo</label>
            <input type="file" name="profile_picture" id="profile_picture" class="form-control">
            @if ($user->profile_picture)
                <img src="{{ Storage::url($user->profile_picture) }}" alt="Profile Photo" class="img-thumbnail mt-3" style="max-width: 150px;">
            @endif
        </div>

        <button type="submit" class="btn btn-primary">Update Profile</button>
    </form>
</div>
@endsection
