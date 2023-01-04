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
Route::get('dashboard', [HomeController::class, 'dashboard'])->middleware('admin');

Route::resource('user', UserController::class);
Route::post('register', [UserController::class, 'register']);
Route::get('profile', [ProfileController::class, 'index']);
Route::post('profile', [ProfileController::class, 'update']);

Route::prefix('produk')->group(function () {
  Route::resource('kategori', KategoriProdukController::class);
  Route::resource('produk', ProdukController::class);
});

Route::get('hapus-gambar/{id}', [GambarProdukController::class, 'hapus_gambar']);

Route::resource('berita', BeritaController::class);

Route::prefix('pangan')->group(function () {
  Route::resource('kategori', KategoriPanganController::class);
  Route::post('harga/import', [HargaPanganController::class, 'import']);
  Route::get('harga/export', [HargaPanganController::class, 'export']);
  Route::resource('harga', HargaPanganController::class);
  Route::get('riwayat/{id}/download', [RiwayatPanganController::class, 'download']);
  Route::resource('riwayat', RiwayatPanganController::class);
});
