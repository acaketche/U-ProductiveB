<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
    <style>
        body {
            background-color: #dcdcdc;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }

        .register-container {
            background-color: #e6ebf3d0;
            padding: 2rem;
            border-radius: 8px;
            border: none;
            width: 500px;
            height: auto;
        }

        .register-container h1 {
            background-color: #4a90e2;
            padding: 0.5rem;
            text-align: center;
            border-radius: 8px 8px 0 0;
            margin: -2rem -2rem 1.5rem -2rem;
            color: #fff;
            font-size: 1.5rem;
        }

        .form-label {
            font-weight: medium;
            font-size: 0.9rem;
        }

        .btn-primary {
            background-color: #4a90e2;
            color: #fff;
            border: none;
            font-weight: medium;
        }

        .btn-primary:hover {
            background-color: #bbd8ff;
        }

        .text-center a {
            color: #ff8c6b;
            font-weight: medium;
            text-decoration: none;
        }

        .text-center a:hover {
            text-decoration: underline;
        }

        .cancel-text a {
            color: #4a90e2;
            font-weight: medium;
            text-decoration: none;
        }

        .cancel-text a:hover {
            text-decoration: underline;
        }
    </style>
</head>

<body>
    <div class="register-container">
        <h1>Daftar</h1>
        <form action="{{ route('register') }}" method="POST">
            @csrf
            <div class="mb-3">
                <label for="name" class="form-label">Username</label>
                <input type="text" class="form-control" id="name" name="name" placeholder="Username" required>
            </div>
            <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <input type="email" class="form-control" id="email" name="email" placeholder="Email" required>
            </div>
            <div class="mb-3">
                <label for="password" class="form-label">Password</label>
                <div class="input-group">
                    <input type="password" class="form-control" id="password" name="password" placeholder="Masukkan Password">
                    <button type="button" class="btn btn-outline-secondary" id="togglePassword">
                    <i class="bi bi-eye-fill" id="toogleIcon"></i>
                    </button>
                </div>
            </div>
            <div class="mb-3">
                <label for="password_confirmation" class="form-label">Confirm Password</label>
                <div class="input-group">
                <input type="password" class="form-control" id="password_confirmation" name="password_confirmation" placeholder="Komfirmasi Password" required>
                <button type="button" class="btn btn-outline-secondary" id="togglePassword">
                    <i class="bi bi-eye-fill" id="toogleIcon"></i>
                    </button>
                </div>
            </div>
            <div class="mb-3">
                <label for="role" class="form-label">Login as</label>
                <select class="form-select" id="role" name="role" required>
                    <option value="Mahasiswa">Mahasiswa</option>
                    <option value="Dosen">Dosen</option>
                    <option value="Admin">Admin</option>
                </select>
            </div>
            <div class="btn-group w-100 mb-2">
                <button type="submit" class="btn btn-primary w-100">Register</button>
            </div>
        </form>

        <div class="mt-3 text-center">
            <p class="cancel-text">Batal, <a href="{{ route('login') }}">Kembali ke halaman Login</a>?</p>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#togglePassword').click(function() {
                const passwordInput = $('#password');
                const type = passwordInput.attr('type') === 'password' ? 'text' : 'password';
                passwordInput.attr('type', type);

                $(this).find('i').toggleClass('bi-eye-slash bi-eye');
            });

            $('#toggleConfirmPassword').click(function() {
                const confirmPasswordInput = $('#password_confirmation');
                const type = confirmPasswordInput.attr('type') === 'password' ? 'text' : 'password';
                confirmPasswordInput.attr('type', type);

                $(this).find('i').toggleClass('bi-eye-slash bi-eye');
            });
        });
    </script>
</body>

</html>

