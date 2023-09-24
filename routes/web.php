<?php

use App\Http\Controllers\BeritaController;
use App\Http\Controllers\GambarProdukController;
use App\Http\Controllers\HargaPanganController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProdukController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\KategoriPanganController;
use App\Http\Controllers\KategoriProdukController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RiwayatPanganController;
use App\Http\Controllers\TransaksiController;
use Illuminate\Support\Facades\Auth;
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

Auth::routes();

Route::get('/', [HomeController::class, 'index']);
Route::get('home', [HomeController::class, 'home']);

Route::get('login-new', [UserController::class, 'index']);
Route::post('loginnew', [UserController::class, 'login']);
Route::post('register', [UserController::class, 'register']);
Route::post('otp', [UserController::class, 'kode_verifikasi']);
Route::get('kode', [UserController::class, 'kode_otp2']);
Route::get('profile', [ProfileController::class, 'index']);
Route::post('profile', [ProfileController::class, 'update']);

Route::middleware('admin')->prefix('admin')->group(function () {
    Route::get('/', [\App\Http\Controllers\Admin\DashboardController::class, 'index']);
    Route::resource('user', \App\Http\Controllers\Admin\UserController::class);
    Route::resource('berita', \App\Http\Controllers\Admin\BeritaController::class);
    Route::resource('kategori-produk', \App\Http\Controllers\Admin\KategoriProdukController::class);
    Route::resource('kategori-pangan', \App\Http\Controllers\Admin\KategoriPanganController::class);
    Route::post('harga-pangan/import', [\App\Http\Controllers\Admin\HargaPanganController::class, 'import']);
    Route::get('harga-pangan/export', [\App\Http\Controllers\Admin\HargaPanganController::class, 'export']);
    Route::resource('harga-pangan', \App\Http\Controllers\Admin\HargaPanganController::class);
    Route::get('riwayat-pangan/{id}/download', [\App\Http\Controllers\Admin\RiwayatPanganController::class, 'download']);
    Route::get('riwayat-pangan/statistik/{id}', [\App\Http\Controllers\Admin\RiwayatPanganController::class, 'statistik']);
    Route::resource('riwayat-pangan', \App\Http\Controllers\Admin\RiwayatPanganController::class);
    Route::get('statistik', [\App\Http\Controllers\Admin\StatistikController::class, 'index']);
});

Route::middleware('petani')->prefix('petani')->group(function () {
    Route::get('/', [\App\Http\Controllers\Petani\DashboardController::class, 'index']);
    Route::get('hapus-gambar/{id}', [\App\Http\Controllers\Petani\GambarProdukController::class, 'hapus_gambar']);
    Route::resource('produk', \App\Http\Controllers\Petani\ProdukController::class);
    Route::get('berita', [\App\Http\Controllers\Petani\BeritaController::class, 'index']);
    Route::get('transaksi', [\App\Http\Controllers\Petani\TransaksiController::class, 'index']);
    Route::get('transaksi/konfirmasi/{id}', [\App\Http\Controllers\Petani\TransaksiController::class, 'konfirmasi']);
    Route::get('transaksi/batalkan/{id}', [\App\Http\Controllers\Petani\TransaksiController::class, 'batalkan']);
    Route::get('cetak-pdf/{id}', [\App\Http\Controllers\Petani\TransaksiController::class, 'cetak_pdf']);
});

Route::middleware('tengkulak')->prefix('tengkulak')->group(function () {
    Route::get('/', [\App\Http\Controllers\Tengkulak\DashboardController::class, 'index']);
    Route::post('produk/konfirmasi/{id}', [\App\Http\Controllers\Tengkulak\ProdukController::class, 'konfirmasi']);
    Route::post('produk/tawar/{id}', [\App\Http\Controllers\Tengkulak\ProdukController::class, 'tawar']);
    Route::resource('produk', \App\Http\Controllers\Tengkulak\ProdukController::class);
    Route::get('berita', [\App\Http\Controllers\Tengkulak\BeritaController::class, 'index']);
    Route::get('transaksi', [\App\Http\Controllers\Tengkulak\TransaksiController::class, 'index']);
    Route::get('cetak-pdf/{id}', [\App\Http\Controllers\Tengkulak\TransaksiController::class, 'cetak_pdf']);
});
