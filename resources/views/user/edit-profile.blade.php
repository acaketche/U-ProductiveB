@extends('layout.navbar-user')
@section('judul')
@section('content')
<div class="container mt-4">
    <h1>Edit Profile</h1>
    <form action="{{ route('profile.update') }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="mb-3">
            <label for="name" class="form-label">Name</label>
            <input type="text" name="name" id="name" class="form-control" value="{{ old('name', $user->name) }}" required>
        </div>

        <div class="mb-3">
            <label for="email" class="form-label">Email</label>
            <input type="email" name="email" id="email" class="form-control" value="{{ old('email', $user->email) }}" required>
        </div>

        <div class="mb-3">
            <label for="password" class="form-label">Password</label>
            <input type="password" name="password" id="password" class="form-control">
            <small class="form-text text-muted">Leave blank if you don't want to change the password.</small>
        </div>

        <div class="mb-3">
            <label for="password_confirmation" class="form-label">Confirm Password</label>
            <input type="password" name="password_confirmation" id="password_confirmation" class="form-control">
        </div>

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
