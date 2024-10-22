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
            background: linear-gradient(to right, #4a90e2, #8a3ab9);
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
            font-family: 'Arial', sans-serif;
        }

        .register-container {
            background-color: #fff;
            padding: 2rem;
            border-radius: 12px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            width: 100%;
            max-width: 500px;
        }

        .register-container h1 {
            text-align: center;
            color: #333;
            font-size: 1.8rem;
            font-weight: bold;
            margin-bottom: 1rem;
        }

        .form-label {
            font-size: 0.9rem;
            font-weight: bold;
            color: #333;
        }

        .btn-primary {
            background-color: #4a90e2;
            border: none;
            padding: 0.75rem;
            border-radius: 6px;
            width: 100%;
            font-size: 1rem;
            font-weight: bold;
            color: #fff;
            transition: background-color 0.3s ease;
        }

        .btn-primary:hover {
            background-color: #357ab8;
        }

        .text-center a {
            color: #4a90e2;
            text-decoration: none;
            font-weight: bold;
        }

        .text-center a:hover {
            text-decoration: underline;
        }

        .input-group button {
            background-color: transparent;
            border: none;
            padding: 0 0.5rem;
            cursor: pointer;
        }

        .input-group button i {
            font-size: 1.25rem;
            color: #4a90e2;
        }

        .text-muted {
            font-size: 0.85rem;
        }
    </style>
</head>

<body>
    <div class="register-container">
        <h1>Register</h1>
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
                    <input type="password" class="form-control" id="password" name="password" placeholder="Masukkan Password" required>
                    <button type="button" class="btn" id="togglePassword">
                        <i class="bi bi-eye-fill" id="togglePasswordIcon"></i>
                    </button>
                </div>
            </div>
            <div class="mb-3">
                <label for="password_confirmation" class="form-label">Confirm Password</label>
                <div class="input-group">
                    <input type="password" class="form-control" id="password_confirmation" name="password_confirmation" placeholder="Konfirmasi Password" required>
                    <button type="button" class="btn" id="toggleConfirmPassword">
                        <i class="bi bi-eye-fill" id="toggleConfirmPasswordIcon"></i>
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
            <button type="submit" class="btn btn-primary">Register</button>
        </form>

        <div class="mt-3 text-center">
            <p class="text-muted">Sudah punya akun? <a href="{{ route('login') }}">Login di sini</a></p>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function () {
            // Toggle password visibility for password
            $('#togglePassword').click(function () {
                const passwordInput = $('#password');
                const type = passwordInput.attr('type') === 'password' ? 'text' : 'password';
                passwordInput.attr('type', type);

                $('#togglePasswordIcon').toggleClass('bi-eye-slash bi-eye');
            });

            // Toggle password visibility for confirm password
            $('#toggleConfirmPassword').click(function () {
                const confirmPasswordInput = $('#password_confirmation');
                const type = confirmPasswordInput.attr('type') === 'password' ? 'text' : 'password';
                confirmPasswordInput.attr('type', type);

                $('#toggleConfirmPasswordIcon').toggleClass('bi-eye-slash bi-eye');
            });
        });
    </script>
</body>

</html>
