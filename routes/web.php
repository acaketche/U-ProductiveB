<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ArticleController;
use App\Http\Controllers\KategoriController;
use App\Http\Controllers\VideoController;

// Public routes
Route::get('/', function () {
    return view('welcome');
});
Route::get('/artikel', [ArticleController::class, 'show'])->name('artikel');

// Guest routes
Route::middleware(['guest'])->group(function() {
    Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [AuthController::class, 'login']);
    Route::get('/register', [AuthController::class, 'showRegisterForm'])->name('register');
    Route::post('/register', [AuthController::class, 'register']);
});

// Authenticated user routes
Route::middleware(['auth'])->group(function() {
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
    Route::get('/userprofile', [ProfileController::class, 'index'])->name('user.profile');
    Route::get('/profile/edit', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::put('/profile', [ProfileController::class, 'update'])->name('profile.update');

    // Article routes for authenticated users
    Route::get('/articles/create', [ArticleController::class, 'create'])->name('articles.create');
    Route::post('/articles', [ArticleController::class, 'store'])->name('articles.store');
    Route::resource('articles', ArticleController::class)->except(['create', 'store']);
});

// Admin routes
Route::middleware(['auth', 'admin'])->group(function() {
    Route::get('/admin/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');
    Route::get('/admin/kelola-user', [UserController::class, 'kelolaUser'])->name('kelola.user');
    Route::delete('/user/{id}', [UserController::class, 'destroy'])->name('delete-user');

    // Kategori routes
    Route::get('/admin/kelola-kategori', [KategoriController::class, 'kelolaKategori'])->name('kelola.kategori');
    Route::get('/tambah-kategori', [KategoriController::class, 'create'])->name('tambah-kategori');
    Route::post('/kategori/store', [KategoriController::class, 'store'])->name('kategori.store');
    Route::delete('/kategori/{id}', [KategoriController::class, 'destroy'])->name('delete-kategori');

    // Admin article management
    Route::post('/admin/approve-article/{id}', [ArticleController::class, 'approve'])->name('admin.approve-article');
    Route::get('/admin/kelola-artikel', [ArticleController::class, 'kelolaArtikel'])->name('kelola.artikel');

    // Other admin routes
    Route::get('/admin/kelola-video', [AdminController::class, 'kelolaVideo'])->name('kelola.video');
    Route::get('/admin/kelola-forum', [AdminController::class, 'kelolaForum'])->name('kelola.forum');

Route::get('/video', [VideoController::class, 'index'])->name('video.index');
// Rute untuk menampilkan form tambah video
Route::get('/video/tambah', [VideoController::class, 'create'])->name('video.create');

// Rute untuk menyimpan video baru
Route::post('/video', [VideoController::class, 'store'])->name('video.store');

Route::get('/video/{video_id}', [VideoController::class, 'show'])->name('video.show');

