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
                        <a class="nav-link " href="#">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="#">Artikel</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Video</a>
                    </li>
                    <li class="nav-item">
                        <button class="btn btn-warning me-2">Login</button>
                    </li>
                    <li class="nav-item">
                        <button class="btn btn-outline-secondary">Register</button>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <div class="container mt-4">
        <div class="d-flex justify-content-center align-items-center mb-4">
            <button class="btn btn-primary me-2" onclick="window.location.href='tambah-artikel.html';">
                <i class="fas fa-plus me-2"></i>Tambah
            </button>
            <div class="d-flex">
                <input type="text" class="form-control me-2" placeholder="Cari Artikel" >
                <div class="dropdown-center">
                    <button class="btn btn-outline-primary dropdown-toggle" type="button" id="filterDropdown" data-bs-toggle="dropdown" aria-expanded="false">
                      Filter
                    </button>

                    <div class="dropdown-menu p-3" style="width: 600px;">
                      <div class="row g-3">
                        <div class="col-6">
                          <label for="kategori" class="form-label">Kategori</label>
                          <select class="form-select" id="tingkatKesulitan">
                            <option selected>Kesehatan</option>
                            <option>Life Hacks</option>
                            <option>Tugas</option>
                          </select>
                        </div>
                        <div class="col-6">
                          <label for="waktu" class="form-label">Waktu</label>
                          <select class="form-select" id="kategori">
                            <option selected>Dalam 24 Jam</option>
                            <option>1 Minggu Terakhir</option>
                            <option>1 Bulan Terakhir</option>
                          </select>
                        </div>
                      </div>
                      <div class="d-flex justify-content-between mt-3">
                        <button type="button" class="btn btn-link text-danger p-0">Bersihkan filter</button>
                        <div>
                          <button type="button" class="btn btn-outline-secondary btn-sm me-2" data-bs-dismiss="dropdown">Batal</button>
                          <button type="button" class="btn btn-primary btn-sm">Terapkan</button>
                        </div>
                      </div>
                    </div>
                  </div>
            </div>
        </div>


        <div class="row">
            @foreach($articles as $article)
                <div class="col-md-4 mb-4">
                    <div class="card h-100">
                        <div class="card-body">
                            <h5 class="card-title">{{ $article->title }}</h5>
                            <p class="card-text">{{ $article->category->name }}</p>
                            <a href="{{ route('articles.show', $article->article_id) }}" class="btn btn-outline-secondary">View</a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        <nav aria-label="Page navigation">
            <ul class="pagination justify-content-center">
                <li class="page-item"><a class="page-link" href="#">Previous</a></li>
                <li class="page-item"><a class="page-link" href="#">1</a></li>
                <li class="page-item"><a class="page-link" href="#">2</a></li>
                <li class="page-item"><a class="page-link" href="#">3</a></li>
                <li class="page-item"><a class="page-link" href="#">...</a></li>
                <li class="page-item"><a class="page-link" href="#">68</a></li>
                <li class="page-item"><a class="page-link" href="#">Next</a></li>
            </ul>
        </nav>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://unpkg.com/feather-icons"></script>
</body>
</html>
