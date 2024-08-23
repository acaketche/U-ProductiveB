<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>U-Productive</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <nav class="navbar navbar-expand-lg ">
        <div class="container-fluid">
            <a class="navbar-brand" href="#"><img src="images/logo.png" alt="Dashboard" class="logo">U-Productive</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="{{route('index') }}">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="artikel.html">Artikel</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="video.html">Video</a>
                    </li>
                    <li class="nav-item">
                        <button class="btn btn-warning me-2">Login</button>
                    </li>
                    <li class="nav-item">
                        <button class="btn btn-outline-secondary">Register</button>
                    </li>
                    <form action="{{ route('logout') }}" method="POST" style="display: inline;">
                        @csrf
                        <button type="submit" class="btn btn-danger">Logout</button>
                    </form>
                </ul>
            </div>
        </div>
    </nav>

    <div class="container mt-4">
        <div class="row">
            <div class="col-md-6">
                <div class="card p-3">
                    <h5 class="card-title">Artikel Populer</h5>
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item">
                            <i class="bi bi-star-fill text-warning"></i>
                            "Panduan Hemat Mahasiswa: Hack Keuangan yang Wajib Diketahui"
                            <p class="small text-muted">Menu description.</p>
                        </li>
                        <li class="list-group-item">
                            <i class="bi bi-star-fill text-warning"></i>
                            "Hack Belajar: Strategi Efektif untuk Menguasai Materi Kuliah dengan Cepat"
                            <p class="small text-muted">Menu description.</p>
                        </li>
                        <li class="list-group-item">
                            <i class="bi bi-star-fill text-warning"></i>
                            "Rahasia Sukses Akademik: Life Hacks untuk Meraih Nilai Terbaik di Tengah Kesibukan Kampus"
                            <p class="small text-muted">Menu description.</p>
                        </li>
                        <li class="list-group-item">
                            <i class="bi bi-star-fill text-warning"></i>
                            "Hack Hidup Mahasiswa: Tips Menghadapi Deadline Tugas yang Menumpuk"
                            <p class="small text-muted">Menu description.</p>
                        </li>
                        <li class="list-group-item">
                            <i class="bi bi-star-fill text-warning"></i>
                            "Hack Mengelola Waktu: Cara Membagi Antara Kuliah, Pekerjaan Part-time, dan Kehidupan Sosial"
                            <p class="small text-muted">Menu description.</p>
                        </li>
                    </ul>
                </div>
            </div>

            <div class="col-md-6">
                <div class="card p-3">
                    <h5 class="card-title">Video Populer</h5>
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item">
                            <i class="bi bi-star-fill text-warning"></i>
                            4 Cara Berubah dari PEMALU JADI PEDE (PERCAYA DIRI)
                            <p class="small text-muted"><a href="https://youtu.be/qWDW8wBK8JU" target="_blank">https://youtu.be/qWDW8wBK8JU</a></p>
                        </li>
                        <li class="list-group-item">
                            <i class="bi bi-star-fill text-warning"></i>
                            Rahasia orang sukses bangun jam 5 pagi? Maudy Ayunda’s Booklist
                            <p class="small text-muted"><a href="https://youtu.be/2FW9Z_0W28k" target="_blank">https://youtu.be/2FW9Z_0W28k</a></p>
                        </li>
                        <li class="list-group-item">
                            <i class="bi bi-star-fill text-warning"></i>
                            Cara tetap penuhi DEADLINE meski tugas BELUM SELESAI dikerjakan (life hack)
                            <p class="small text-muted"><a href="https://youtu.be/CZqgEFNBHZs" target="_blank">https://youtu.be/CZqgEFNBHZs</a></p>
                        </li>
                    </ul>
                </div>
            </div>
        </div>

        <div class="row mt-4">
            <div class="col-md-6">
                <div class="card p-3">
                    <h5 class="card-title">Title</h5>
                    <p class="card-text">Body text.</p>
                </div>
            </div>
            <div class="col-md-6">
                <div class="card p-3">
                    <h5 class="card-title">E-BOOK</h5>
                    <p class="card-text">Body text for your whole article or post. We'll put in some lorem ipsum to show how a filled-out page might look;</p>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
