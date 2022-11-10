<?php

use App\Http\Controllers\BeritaController;
use App\Http\Controllers\GambarProdukController;
use App\Http\Controllers\HargaPanganController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProdukController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\KategorihargaController;
use App\Http\Controllers\KategoriprodukController;
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
Route::get('profile/{id}', [UserController::class, 'profile']);

Route::resource('produk', ProdukController::class);
Route::get('hapus-gambar/{id}', [GambarProdukController::class, 'hapus_gambar']);

Route::resource('berita', BeritaController::class);
Route::resource('kategoriharga', KategorihargaController::class);
Route::resource('kategoriproduk', KategoriprodukController::class);
Route::resource('hargapangan', HargaPanganController::class);