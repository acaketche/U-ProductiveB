<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
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

        .login-container {
            background-color: #e6ebf3d0;
            padding: 2rem;
            border-radius: 8px;
            border: none;
            width: 500px;
            height: 460px;
        }

        .login-container h1 {
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

        .mt-3 a {
            margin: 0 15px;
            color: #F49881;
        }

        .input-group-text {
            cursor: pointer;
        }
    </style>
</head>

<body>
    <div class="login-container">
        <h1>Login</h1>
        <form action="/login" method="POST">
            <div class="mb-3">
                <label for="email" class="form-label">Username </label>
                <input type="email" class="form-control" id="email" name="email" placeholder="Username" required>
            </div>
            <div class="mb-3">
                <label for="password" class="form-label">Kata Sandi</label>
                <div class="input-group">
                    <input type="password" class="form-control" id="password" name="password" placeholder="Kata Sandi" required>
                    <span class="input-group-text" id="togglePassword"><i class="bi bi-eye-slash"></i></span>
                </div>
            </div>

            <!-- Dropdown untuk memilih role -->
            <div class="mb-3">
                <label for="role" class="form-label">Login sebagai</label>
                <select class="form-select" id="role" name="role" required>
                    <option value="mahasiswa">Mahasiswa</option>
                    <option value="dosen">Dosen</option>
                    <option value="admin">Admin</option>
                </select>
            </div>

            <div class="btn-group w-100 mb-2">
                <button type="submit" class="btn btn-primary w-100">Login</button>
            </div>
        </form>
        <div class="mt-3 text-center">
            <p>Belum punya Akun? <a href="#">Daftar Disini</a></p>
            <a href="#">About</a>
            <a href="#">Contact</a>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

    <!-- Script untuk toggle visibilitas password -->
    <script>
        const togglePassword = document.querySelector('#togglePassword');
        const password = document.querySelector('#password');

        togglePassword.addEventListener('click', function () {
            // Toggle tipe input antara password dan text
            const type = password.getAttribute('type') === 'password' ? 'text' : 'password';
            password.setAttribute('type', type);

            // Toggle ikon mata antara slash dan eye
            this.querySelector('i').classList.toggle('bi-eye-slash');
            this.querySelector('i').classList.toggle('bi-eye');
        });
    </script>
</body>

</html>
