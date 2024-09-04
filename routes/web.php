<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ArticleController;
use App\Http\Controllers\KategoriController;
use App\Http\Controllers\VideoController;



Route::get('/artikel', [ArticleController::class,'show'])->name('artikel');

Route::get('/', function () {
    return view('welcome');
});


//login
// Route::middleware(['guest'])->group(function(){
    Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [AuthController::class, 'login']);
    Route::get('/register', [AuthController::class, 'showRegisterForm'])->name('register');
    Route::post('/register', [AuthController::class, 'register']);
// });

// Route::middleware(['auth'])->group(function(){
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
// });

// Route::middleware('auth')->group(function () {
    Route::get('/userprofile', [ProfileController::class, 'index'])->name('user.profile');
    Route::get('/profile/edit', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::put('/profile', [ProfileController::class, 'update'])->name('profile.update');
// });

// Route::middleware(['auth'])->group(function () {
    Route::get('/admin/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');
    Route::get('/admin/kelola-user', [UserController::class, 'kelolaUser'])->name('kelola.user');
    Route::delete('/user/{id}', [UserController::class, 'destroy'])->name('delete-user');
    //kategori
    Route::get('/admin/kelola-kategori', [KategoriController::class, 'kelolaKategori'])->name('kelola.kategori');
    Route::get('/tambah-kategori', [KategoriController::class, 'create'])->name('tambah-kategori');
    Route::post('/kategori/store', [KategoriController::class, 'store'])->name('kategori.store');
    Route::delete('/kategori/{id}', [KategoriController::class, 'destroy'])->name('delete-kategori');

    Route::get('/admin/kelola-artikel', [AdminController::class, 'kelolaArtikel'])->name('kelola.artikel');
    Route::get('/admin/kelola-video', [AdminController::class, 'kelolaVideo'])->name('kelola.video');
    Route::get('/admin/kelola-forum', [AdminController::class, 'kelolaForum'])->name('kelola.forum');
// });

Route::get('/video', [VideoController::class, 'index'])->name('video.index');
// Rute untuk menampilkan form tambah video
Route::get('/video/tambah', [VideoController::class, 'create'])->name('video.create');

// Rute untuk menyimpan video baru
Route::post('/video', [VideoController::class, 'store'])->name('video.store');

Route::get('/video/{video_id}', [VideoController::class, 'show'])->name('video.show');



