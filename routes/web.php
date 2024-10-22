<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ArticleController;
use App\Http\Controllers\KategoriController;
use App\Http\Controllers\VideoController;
use App\Http\Controllers\HistoryController;
use App\Http\Controllers\FavoriteController;
use App\Http\Controllers\ForumController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\UtamaController;
use App\Http\Controllers\TeknikSipilController;
use App\Http\Controllers\PDFExportController;

Route::get('/export-pdf', [PDFExportController::class, 'exportPDF'])->name('export.pdf');

Route::get('/', function () {
    return redirect()->route('home');
 });

Route::get('/home', [UtamaController::class,'index'])->name('home');
Route::get('/artikel/{id}', [ArticleController::class, 'show'])->name('articles.show');
Route::get('/artikel', [ArticleController::class, 'index'])->name('articles.index');
Route::get('/video', [VideoController::class, 'index'])->name('video.index');
Route::get('/video/{video_id}', [VideoController::class, 'show'])->name('video.show');
// Guest routes
Route::middleware(['guest'])->group(function() {

    Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [AuthController::class, 'login']);
    Route::get('/register', [AuthController::class, 'showRegisterForm'])->name('register');
    Route::post('/register', [AuthController::class, 'register']);

});

Route::group(['middleware' => ['role:mahasiswa,dosen']], function() {
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
    Route::get('/userprofile', [ProfileController::class, 'index'])->name('user.profile');
    Route::get('/profile/edit', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::put('/profile', [ProfileController::class, 'update'])->name('profile.update');

        // Article routes for authenticated users
        Route::get('/articles/create', [ArticleController::class, 'create'])->name('articles.create');
        Route::post('/articles', [ArticleController::class, 'store'])->name('articles.store');
        Route::resource('articles', ArticleController::class)->except(['create', 'store']);

    // Rute untuk menampilkan form tambah video
    Route::get('/video/tambah', [VideoController::class, 'create'])->name('video.create');

    // Rute untuk menyimpan video baru
    Route::post('/video', [VideoController::class, 'store'])->name('video.store');
    Route::get('/history', [HistoryController::class, 'index'])->name('history.index');


    // Rute untuk menampilkan halaman profil
    Route::get('/profile', [ProfileController::class, 'index'])->name('profile');

    // Rute untuk mengupdate profil dengan metode PUT
    Route::put('/profile', [ProfileController::class, 'update'])->name('profile.update');

    //rute untuk favorite
    Route::post('/favorite/toggle', [FavoriteController::class, 'toggle'])->name('favorite.toggle');
    Route::get('/favorites', [FavoriteController::class, 'index'])->name('favorite.index');
    // Route::post('favorite/{post}', [App\Http\Controllers\FavoriteController::class, 'favorite']);
    // Route::post('unfavorite/{post}', [App\Http\Controllers\FavoriteController::class, 'unfavorite']);
    // Rute untuk menghapus favorit
    Route::post('/post/{post}/unfavorite', [FavoriteController::class, 'unfavorite'])->name('post.unfavorite');


    //route midelwarre favorite
    Route::middleware(['auth'])->group(function () {
        Route::post('/favorite/{post}', [FavoriteController::class, 'toggleFavorite']);
    });

    //forum
    Route::get('/forum', [ForumController::class, 'index'])->name('forum.index');
    Route::get('/forum/create', [ForumController::class, 'create'])->name('forum.create');
    Route::post('/forum', [ForumController::class, 'store'])->name('forum.store');
    Route::get('/forum/{id}', [ForumController::class, 'show'])->name('forum.show');
    // Rute untuk menambahkan favorit
    Route::post('/post/{post}/favorite', [ForumController::class, 'favorite'])->name('post.favorite');
    // Route::post('/forum/{id}/favorite', [ForumPostController::class, 'favorite'])->middleware('auth');
    // Route::post('/forum/{id}/unfavorite', [ForumPostController::class, 'unfavorite'])->middleware('auth');
    // Route::get('/forum', [ForumController::class, 'index'])->middleware('auth');
    // Route::get('/my-favorites', [App\Http\Controllers\ForumController::class, 'myFavorites']);


    //comentar
    Route::get('/comment/{post_id}', [CommentController::class, 'create'])->name('comments.create');
    Route::post('/comment', [CommentController::class, 'store'])->name('comments.store');
});


Route::group(['middleware' => ['role:admin']], function() {
    Route::post('/logoutadmin', [AdminController::class, 'logout'])->name('logoutadmin');
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
    Route::post('/admin/reject-article/{id}', [ArticleController::class, 'reject'])->name('admin.reject-article');
    Route::get('/admin/kelola-artikel', [ArticleController::class, 'kelolaArtikel'])->name('kelola.artikel');
    Route::delete('/admin/artikel/{id}', [ArticleController::class, 'destroy'])->name('delete-artikel');

    Route::get('/admin/kelola-video', [VideoController::class, 'kelolaVideo'])->name('kelola.video');
    Route::delete('/admin/video/{id}', [VideoController::class, 'destroy'])->name('delete-video');
    Route::post('/admin/approve-video/{id}', [VideoController::class, 'approve'])->name('admin.approve-video');
    Route::post('/admin/reject-video/{id}', [VideoController::class, 'reject'])->name('admin.reject-video');
    // Other admin routes

    Route::get('/kelola-forum', [AdminController::class, 'kelolaForum'])->name('kelola.forum');
    Route::delete('/kelola-forum/post/{id}', [AdminController::class, 'destroyPost'])->name('delete-forum-post');
    Route::get('/kelola-forum/post/{id}/comments', [AdminController::class, 'viewComments'])->name('view-comments');
    Route::delete('/kelola-forum/comment/{id}', [AdminController::class, 'destroyComment'])->name('delete-comment');
});


// Route untuk menampilkan daftar teknik sipil (index)
Route::get('teknik_sipil', [TeknikSipilController::class, 'index'])->name('teknik_sipil.index');
// Route untuk menampilkan form tambah teknik sipil (create)
Route::get('teknik_sipil/create', [TeknikSipilController::class, 'create'])->name('teknik_sipil.create');

Route::get('/generate-thumbnail', [TeknikSipilController::class, 'generateThumbnailFromAPI']);

// Route untuk menyimpan data teknik sipil baru (store)
Route::post('teknik_sipil', [TeknikSipilController::class, 'store'])->name('teknik_sipil.store');
// Route untuk menampilkan detail teknik sipil (show)
Route::get('teknik_sipil/{teknik_sipil}', [TeknikSipilController::class, 'show'])->name('teknik_sipil.show');
// Route untuk menampilkan form edit teknik sipil (edit)
Route::get('teknik_sipil/{teknik_sipil}/edit', [TeknikSipilController::class, 'edit'])->name('teknik_sipil.edit');
// Route untuk memperbarui data teknik sipil (update)
Route::put('teknik_sipil/{teknik_sipil}', [TeknikSipilController::class, 'update'])->name('teknik_sipil.update');
// Route untuk menghapus teknik sipil (destroy)
Route::delete('teknik_sipil/{teknik_sipil}', [TeknikSipilController::class, 'destroy'])->name('teknik_sipil.destroy');
