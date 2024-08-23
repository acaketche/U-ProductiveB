<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile - U-Productive</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
    <link rel="stylesheet" href="styles.css">
    <style>
        .profile-header {
            display: flex;
            align-items: center;
            padding: 20px 0;
            border-bottom: 1px solid #ddd;
        }
        .profile-header img {
            width: 150px;
            height: 150px;
            border-radius: 50%;
            object-fit: cover;
            margin-right: 30px;
        }
        .profile-details h3 {
            margin-bottom: 5px;
        }
        .profile-details p {
            margin: 5px 0;
            color: #777;
        }
        .profile-details .stats {
            display: flex;
            gap: 20px;
            margin-top: 10px;
        }
        .profile-details .stats .stat-item {
            text-align: center;
        }
        .profile-details .stats .stat-item h4 {
            margin: 0;
            font-size: 20px;
            font-weight: bold;
        }
        .profile-details .stats .stat-item p {
            margin: 0;
            color: #555;
        }
        .profile-content {
            margin-top: 30px;
        }
        .profile-content h4 {
            margin-bottom: 20px;
        }
        .profile-content .content-item {
            margin-bottom: 30px;
        }
        .profile-content .content-item img {
            width: 100%;
            height: 200px;
            object-fit: cover;
            border-radius: 10px;
            margin-bottom: 10px;
        }
        .profile-content .content-item h5 {
            margin-bottom: 5px;
        }
        .profile-content .content-item p {
            color: #777;
        }
    </style>
</head>
<body>
    <nav class="navbar navbar-expand-lg">
        <div class="container-fluid">
            <a class="navbar-brand" href="#"><img src="images/logo.png" alt="Dashboard" class="logo">U-Productive</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="#">Profile</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="menuutama.html">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="artikel.html">Artikel</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="video.html">Video</a>
                    </li>
                   <form action="{{ route('logout') }}" method="POST" style="display: inline;">
                        @csrf
                        <button type="submit" class="btn btn-warning">Logout</button>
                    </form>
                </ul>
            </div>
        </div>
    </nav>

    <div class="container mt-4">
        <!-- Profile Header -->
        <div class="profile-header">
            <img src="images/logo.png" alt="Profile Picture">
            <div class="profile-details">
                <h3>User Name</h3>
                <p>@username</p>
                <div class="stats">
                    <div class="stat-item">
                        <h4>15</h4>
                        <p>Articles</p>
                    </div>
                    <div class="stat-item">
                        <h4>8</h4>
                        <p>Videos</p>
                    </div>
                </div>
                <button class="btn btn-outline-secondary mt-3">Edit Profile</button>
            </div>
        </div>

        <!-- Profile Content -->
        <div class="profile-content">
            <h4>My Content</h4>
            <div class="row">
                <!-- Article Item -->
                <div class="col-md-4 content-item">
                    <img src="images/artikel1.jpg" alt="Article Image">
                    <h5>Article Title</h5>
                    <p>Category: Life Hacks</p>
                </div>
                <!-- Video Item -->
                <div class="col-md-4 content-item">
                    <iframe class="card-img-top" src="https://www.youtube.com/embed/-_ECgiE2n9o" title="YouTube video player" frameborder="0" allowfullscreen></iframe>
                    <h5>Video Title</h5>
                    <p>Category: Kesehatan</p>
                </div>
                <!-- Additional Items can be added similarly -->
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
