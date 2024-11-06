<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\{
    AuthController, UserController, AdminController, ProfileController, ArticleController, KategoriController,
    VideoController, HistoryController, FavoriteController, ForumController, CommentController,
    UtamaController, InformaticaController, TeknikSipilController, PDFExportController, TeknikComputerController, ProdiController
};

// General Routes
Route::get('/export-pdf', [PDFExportController::class, 'exportPDF'])->name('export.pdf');
Route::get('/', fn() => redirect()->route('home'));
Route::get('/home', [UtamaController::class, 'index'])->name('home');
Route::get('/artikel/{id}', [ArticleController::class, 'show'])->name('articles.show');
Route::get('/artikel', [ArticleController::class, 'index'])->name('articles.index');
Route::get('/video', [VideoController::class, 'index'])->name('video.index');
Route::get('/video/{video_id}', [VideoController::class, 'show'])->name('video.show');
Route::get('/informatica', [InformaticaController::class, 'index'])->name('informatica.index');
Route::get('/informatica/{id}', [InformaticaController::class, 'show'])->name('informatica.show');

Route::middleware('auth')->group(function() {
    Route::get('/articles/create', [ArticleController::class, 'create'])->name('articles.create');
    Route::post('/articles', [ArticleController::class, 'store'])->name('articles.store');
    Route::get('/tambah-video', [VideoController::class, 'create'])->name('tambah-video');
    Route::post('/video', [VideoController::class, 'store'])->name('video.store');
    Route::post('/informatica', [InformaticaController::class, 'store'])->name('informatica.store');
    Route::get('/informatics/create', [InformaticaController::class, 'create'])->name('informatica.create'); // Route untuk create
    Route::get('/informatica/move-file', [InformaticaController::class, 'moveFile']);

});


// Guest Routes
Route::middleware('guest')->group(function() {
    Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [AuthController::class, 'login']);
    Route::get('/register', [AuthController::class, 'showRegisterForm'])->name('register');
    Route::post('/register', [AuthController::class, 'register']);
});

// Authenticated User Routes (Mahasiswa & Dosen)
Route::middleware('role:mahasiswa,dosen')->group(function() {
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
    Route::get('/userprofile', [ProfileController::class, 'index'])->name('user.profile');
    Route::get('/profile/edit', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::put('/profile', [ProfileController::class, 'update'])->name('profile.update');

    // Articles
    Route::resource('articles', ArticleController::class)
    ->only(['edit', 'update', 'destroy']);

    //informatics
    Route::resource('informatics', InformaticaController::class)
    ->only(['edit', 'update', 'destroy']);

    // Videos
    Route::resource('video', VideoController::class)
    ->only(['edit', 'update', 'destroy']);

    // History & Profile
    Route::get('/history', [HistoryController::class, 'index'])->name('history.index');
    Route::get('/profile', [ProfileController::class, 'index'])->name('profile');

    // Favorites
    Route::post('/favorite/toggle', [FavoriteController::class, 'toggle'])->name('favorite.toggle');
    Route::get('/favorites', [FavoriteController::class, 'index'])->name('favorite.index');
    Route::post('/post/{post}/unfavorite', [FavoriteController::class, 'unfavorite'])->name('post.unfavorite');
    Route::post('/post/{post}/favorite', [FavoriteController::class, 'favorite'])->name('post.favorite');
    Route::post('/favorite/{postId}', [FavoriteController::class, 'store'])->name('favorite.store');


    // Forum
    Route::get('/forum', [ForumController::class, 'index'])->name('forum.index');
    Route::get('/forum/create', [ForumController::class, 'create'])->name('forum.create');
    Route::post('/forum', [ForumController::class, 'store'])->name('forum.store');
    Route::get('/forum/{id}', [ForumController::class, 'show'])->name('forum.show');

    // Comments
    Route::get('/comment/{post_id}', [CommentController::class, 'create'])->name('comments.create');
    Route::post('/comments/store', [CommentController::class, 'store'])->name('comments.store');

});

// Admin Routes
Route::middleware('role:admin')->group(function() {
    Route::post('/logoutadmin', [AdminController::class, 'logout'])->name('logoutadmin');
    Route::get('/admin/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');

    // User Management
    Route::get('/admin/kelola-user', [Admincontroller::class, 'kelolaUser'])->name('kelola.user');
    Route::delete('/user/{id}', [UserController::class, 'destroy'])->name('delete-user');

    // Category Management
    Route::get('/admin/kelola-kategori', [KategoriController::class, 'kelolaKategori'])->name('kelola.kategori');
    Route::get('/tambah-kategori', [KategoriController::class, 'create'])->name('tambah-kategori');
    Route::post('/kategori/store', [KategoriController::class, 'store'])->name('kategori.store');
    Route::delete('/kategori/{id}', [KategoriController::class, 'destroy'])->name('delete-kategori');

    // Articles Management
    Route::post('/admin/approve-article/{id}', [ArticleController::class, 'approve'])->name('admin.approve-article');
    Route::post('/admin/reject-article/{id}', [ArticleController::class, 'reject'])->name('admin.reject-article');
    Route::get('/admin/kelola-artikel', [ArticleController::class, 'kelolaArtikel'])->name('kelola.artikel');
    Route::delete('/admin/artikel/{id}', [ArticleController::class, 'destroy'])->name('delete-artikel');

    // Videos Management
    Route::get('/admin/kelola-video', [VideoController::class, 'kelolaVideo'])->name('kelola.video');
    Route::delete('/admin/video/{id}', [VideoController::class, 'destroy'])->name('delete-video');
    Route::post('/admin/approve-video/{id}', [VideoController::class, 'approve'])->name('admin.approve-video');
    Route::post('/admin/reject-video/{id}', [VideoController::class, 'reject'])->name('admin.reject-video');

    // Forum Management
    Route::get('/kelola-forum', [AdminController::class, 'kelolaForum'])->name('kelola.forum');
    Route::delete('/kelola-forum/post/{id}', [AdminController::class, 'destroyPost'])->name('delete-forum-post');
    Route::get('/kelola-forum/post/{id}/comments', [AdminController::class, 'viewComments'])->name('view-comments');
    Route::delete('/kelola-forum/comment/{id}', [AdminController::class, 'destroyComment'])->name('delete-comment');
});


// Route untuk menampilkan daftar teknik sipil (index)
// Teknik Sipil Routes
Route::get('teknik_sipil', [TeknikSipilController::class, 'index'])->name('teknik_sipil.index');
Route::get('teknik_sipil/create', [TeknikSipilController::class, 'create'])->name('teknik_sipil.create');
Route::post('teknik_sipil', [TeknikSipilController::class, 'store'])->name('teknik_sipil.store');
Route::get('teknik_sipil/{teknik_sipil}', [TeknikSipilController::class, 'show'])->name('teknik_sipil.show');
Route::get('teknik_sipil/{teknik_sipil}/edit', [TeknikSipilController::class, 'edit'])->name('teknik_sipil.edit');
Route::put('teknik_sipil/{teknik_sipil}', [TeknikSipilController::class, 'update'])->name('teknik_sipil.update');
Route::delete('teknik_sipil/{teknik_sipil}', [TeknikSipilController::class, 'destroy'])->name('teknik_sipil.destroy');



Route::get('teknik_computer', [TeknikComputerController::class, 'index'])->name('teknik_computer.index');
Route::get('teknik_computer/create', [TeknikComputerController::class, 'create'])->name('teknik_computer.create');
Route::post('teknik_computer', [TeknikComputerController::class, 'store'])->name('teknik_computer.store');
Route::get('teknik_computer/{teknik_computer}', [TeknikComputerController::class, 'show'])->name('teknik_computer.show');


Route::get('/generate-thumbnail', [TeknikSipilController::class, 'generateThumbnailFromAPI']);

Route::get('prodi', [ProdiController::class, 'index'])->name('prodi.index');
Route::get('prodi/{prodi_id}', [ProdiController::class, 'show'])->name('prodi.show');
