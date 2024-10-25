<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>U-Productive Login</title>
    <script src="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
    <style>
        body {
            background: linear-gradient(to right, #4a90e2, #9b59b6);
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
            font-family: 'Arial', sans-serif;
        }

        .login-container {
            background-color: #fff;
            padding: 2.5rem;
            border-radius: 12px;
            box-shadow: 0 4px 16px rgba(0, 0, 0, 0.1);
            width: 100%;
            max-width: 400px;
        }

        .input-group-text {
            cursor: pointer;
        }

        .btn-primary:hover {
            background-color: #3a7bd5;
        }

        h1 {
            font-size: 1.75rem;
            font-weight: bold;
            text-align: center;
            margin-bottom: 0.5rem;
            color: #333;
        }

        h2 {
            font-size: 1.125rem;
            text-align: center;
            margin-bottom: 2rem;
            color: #555;
        }

        .form-label {
            font-size: 0.875rem;
            color: #555;
            font-weight: 600;
        }

        input, select {
            width: 100%;
            margin-top: 0.5rem;
            padding: 0.5rem;
            border: 1px solid #ccc;
            border-radius: 0.375rem;
            font-size: 0.875rem;
            color: #333;
            box-sizing: border-box;
        }

        button[type="submit"] {
            margin-top: 1rem;
            background-color: #4a90e2;
            color: white;
            font-weight: 600;
            padding: 0.75rem;
            border-radius: 0.375rem;
            width: 100%;
        }

        button[type="submit"]:hover {
            background-color: #3b82d1;
        }

        .text-center {
            margin-top: 1.5rem;
            font-size: 0.875rem;
            text-align: center;
            justify-content: center;
        }

        .text-center a {
            color: #4a90e2;
            font-weight: 600;
            text-decoration: none;
        }

        .text-center a:hover {
            text-decoration: underline;
        }

        .footer-links {
            display: flex;
            justify-content: center;
            margin-top: 2rem;
            gap: 1rem;
        }

        .footer-links a {
            font-size: 0.875rem;
            color: #4a90e2;
        }

        .footer-links a:hover {
            text-decoration: underline;
        }

        .relative input {
            padding-left: 2.5rem;
        }

        .relative i {
            position: absolute;
            left: 0.75rem;
            top: 50%;
            transform: translateY(-50%);
            color: #999;
        }

        .relative button {
            right: 0.75rem;
            top: 50%;
            transform: translateY(-50%);
        }
    </style>
</head>
<body>
    <div class="login-container">
        <h1>Welcome to U-Productive</h1>
        <h2>Master Your University Life</h2>

        <!-- Tampilkan alert jika ada error -->
        @if ($errors->any())
            <script>
                alert("{{ $errors->first('name') }}");
            </script>
        @endif

        <form action="{{ route('login') }}" method="POST">
            @csrf
            <div class="mb-4 relative">
                <label for="name" class="form-label">Username</label>
                <input type="text" id="name" name="name" placeholder="Username" value="{{ old('name') }}" required>
                <i class="bi bi-person"></i>
            </div>

            <div class="mb-4 relative">
                <label for="password" class="form-label">Password</label>
                <input type="password" id="password" name="password" placeholder="Masukkan Password" required>
                <i class="bi bi-lock"></i>
                <button type="button" class="absolute text-gray-400" id="togglePassword">
                    <i class="bi bi-eye-fill" id="toggleIcon"></i>
                </button>
            </div>

            <div class="mb-4">
                <label for="role" class="form-label">Login as</label>
                <select id="role" name="role" required>
                    <option value="Mahasiswa">Mahasiswa</option>
                    <option value="Dosen">Dosen</option>
                    <option value="Admin">Admin</option>
                </select>
            </div>

            <button type="submit">Login</button>
        </form>

        <div class="text-center mt-4">
            <p>Don't have an account? <a href="{{ route('register') }}">Register here</a></p>
        </div>
    </div>

    <script>
        document.getElementById('togglePassword').addEventListener('click', function () {
            const passwordInput = document.getElementById('password');
            const type = passwordInput.getAttribute('type') === 'password' ? 'text' : 'password';
            passwordInput.setAttribute('type', type);

            const toggleIcon = document.getElementById('toggleIcon');
            toggleIcon.classList.toggle('bi-eye-slash');
            toggleIcon.classList.toggle('bi-eye');
        });
    </script>
</body>
</html>
