<?php

use App\Http\Controllers\BukuController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\HomepageController;
use App\Http\Controllers\KategoriController;
use App\Http\Controllers\KoleksiPribadiController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\LogoutController;
use App\Http\Controllers\PeminjamanController;
use App\Http\Controllers\PeminjamanUserController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\UlasanController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    //
});
// Route::get('/bar-chart', [ChartController::class, 'barChart']);

Route::group(['prefix' => 'auth'],  function () {
    // Route untuk halaman login
    Route::get('/login', [LoginController::class, 'index'])->name('login');
    Route::post('/login', [LoginController::class, 'login'])->name('login.post');


    // Route untuk halaman register
    Route::get('/register', [RegisterController::class, 'index'])->name('register');
    Route::post('/register', [RegisterController::class, 'registerUser'])->name('register.post');
    Route::get('/registeradmin', [RegisterController::class, 'indexAdmin'])->name('registeradmin');
    Route::post('/registeradmin', [RegisterController::class, 'registerAdmin'])->name('registeradmin.post');
    Route::get('/registeradmin/verify/{token}', [RegisterController::class, 'verifyAccount'])->name('user.verify');

    // Route untuk Logout
    Route::get('/logout', [LogoutController::class, 'logout'])->name('logout');
});


Route::group(['prefix' => 'dashboard', 'middleware' => ['role:admin|petugas']], function () {
    Route::get('/', [DashboardController::class, 'index'])->name('dashboard.index');


    Route::get('/buku', [BukuController::class, 'index'])->name('buku.index');
    Route::get('/buku/{BukuID}', [BukuController::class, 'show'])->name('buku.show');
    Route::get('/bukuprint', [BukuController::class, 'store'])->name('buku.store');
    Route::get('/bukuexcel', [BukuController::class, 'exportexcel'])->name('buku.excel');
    Route::post('/createbuku', [BukuController::class, 'create'])->name('buku.create');
    Route::put('/buku/{BukuID}', [BukuController::class, 'update'])->name('buku.update');
    Route::delete('/buku/{BukuID}', [BukuController::class, 'delete'])->name('buku.delete');


    Route::get('/kategori', [KategoriController::class, 'index'])->name('kategori.index');
    Route::get('/kategori/{KategoriID}', [KategoriController::class, 'show'])->name('kategori.show');
    Route::post('/createkategori', [KategoriController::class, 'create'])->name('kategori.create');
    Route::put('/kategori/{KategoriID}', [KategoriController::class, 'update'])->name('kategori.update');
    Route::delete('/kategori/{KategoriID}', [KategoriController::class, 'delete'])->name('kategori.delete');


    Route::get('/peminjaman', [PeminjamanController::class, 'index'])->name('peminjaman.index');
    Route::get('/peminjaman/kedaluwarsa', [PeminjamanController::class, 'indexkedaluwarsa'])->name('peminjaman.kedaluwarsa.index');
    Route::get('/peminjaman/kedaluwarsa/{PeminjamanID}', [PeminjamanController::class, 'showkedaluwarsa'])->name('peminjaman.kedaluwarsa.show');
    Route::get('/peminjaman/diterima', [PeminjamanController::class, 'indexdikembalikan'])->name('peminjaman.dikembalikan.index');
    Route::get('/peminjaman/diterima/{PeminjamanID}', [PeminjamanController::class, 'showditerima'])->name('peminjaman.dikembalikan.show');
    Route::get('/peminjaman/{PeminjamanID}', [PeminjamanController::class, 'show'])->name('peminjaman.show');
    Route::post('/createpeminjaman', [PeminjamanController::class, 'create'])->name('peminjaman.create');
    Route::put('/peminjaman/update/{PeminjamanID}', [PeminjamanController::class, 'update'])->name('peminjaman.update');
    Route::put('/peminjaman/{PeminjamanID}', [PeminjamanController::class, 'editstatus'])->name('peminjaman.updatestatus');
    Route::delete('/peminjaman/{PeminjamanID}', [PeminjamanController::class, 'delete'])->name('peminjaman.delete');


    Route::get('/users', [UserController::class, 'index'])->name('users.index');
    Route::get('/users/{userid}', [UserController::class, 'show'])->name('users.show');
    Route::post('/createusers', [UserController::class, 'create'])->name('users.create');
    Route::post('/createpetugas', [UserController::class, 'registerAdmin'])->name('users.create.petugas');
    Route::put('/users/{userid}', [UserController::class, 'update'])->name('users.update');
    Route::delete('/users/{userid}', [UserController::class, 'delete'])->name('users.delete');
});


Route::group(['prefix' => 'homepage'], function () {
    Route::get('/', [HomepageController::class, 'index'])->name('homepage.index');

    Route::get('/profile/{userid}', [HomepageController::class, 'showprofile'])->name('profile.show');
    Route::put('/profile/{userid}', [HomepageController::class, 'updateprofile'])->name('profile.update');


    Route::get('/peminjaman', [PeminjamanUserController::class, 'index'])->name('user.peminjaman.show')->middleware('role:peminjam');
    Route::post('/buatpeminjaman', [PeminjamanUserController::class, 'create'])->name('user.peminjaman.create')->middleware('role:peminjam');

    Route::get('/koleksi', [KoleksiPribadiController::class, 'index'])->name('user.koleksi.show')->middleware('role:peminjam');
    Route::get('/koleksi/{KoleksiID}', [KoleksiPribadiController::class, 'show'])->name('koleksi.lihat')->middleware('role:peminjam');
    Route::put('/koleksi/buku/{KoleksiID}', [KoleksiPribadiController::class, 'updatebook'])->name('koleksi.buku.update')->middleware('role:peminjam');
    Route::delete('/koleksi/buku/{KoleksiID}', [KoleksiPribadiController::class, 'deletebook'])->name('koleksi.buku.delete')->middleware('role:peminjam');

    Route::get('/ulasan', [UlasanController::class, 'index'])->name('user.ulasan.show')->middleware('role:peminjam');
    Route::post('/ulasan', [UlasanController::class, 'create'])->name('user.ulasan.create')->middleware('role:peminjam');
    Route::put('/ulasan/{UlasanID}', [UlasanController::class, 'update'])->name('user.ulasan.update')->middleware('role:peminjam');
    Route::delete('/ulasan/{UlasanID}', [UlasanController::class, 'delete'])->name('user.ulasan.delete')->middleware('role:peminjam');

    Route::get('/buku/{BukuID}', [HomepageController::class, 'show'])->name('homepage.book.show')->middleware('role:peminjam');
    Route::get('/searchbuku', [HomepageController::class, 'searchbuku'])->name('buku.search')->middleware('role:peminjam');
    Route::get('/buku', [HomepageController::class, 'indexbuku'])->name('homepage.book.index')->middleware('role:peminjam');
    Route::post('/sort-buku', [HomepageController::class, 'sortBuku'])->name('homepage.book.sort')->middleware('role:peminjam');


    Route::get('/kategori', [HomepageController::class, 'indexkategori'])->name('homepage.kategori.index')->middleware('role:peminjam');
    Route::get('/kategori/{KategoriID}', [HomepageController::class, 'showkategori'])->name('homepage.kategori.show')->middleware('role:peminjam');



    Route::post('/createkoleksi', [KoleksiPribadiController::class, 'create'])->name('koleksi.create')->middleware('role:peminjam');
    Route::post('/createkoleksi/{KoleksiID}', [KoleksiPribadiController::class, 'createcollect'])->name('koleksi.create.collect')->middleware('role:peminjam');
    Route::delete('/koleksi/redirect/{KoleksiID}', [KoleksiPribadiController::class, 'deleteredirect'])->name('koleksi.delete.redirect')->middleware('role:peminjam');
    Route::delete('/koleksi/{KoleksiID}', [KoleksiPribadiController::class, 'delete'])->name('koleksi.delete')->middleware('role:peminjam');

    Route::post('/pinjam', [PeminjamanUserController::class, 'create'])->name('pinjam.create')->middleware('role:peminjam');


    Route::get('/read', [HomepageController::class, 'read'])->name('book.read');


});
