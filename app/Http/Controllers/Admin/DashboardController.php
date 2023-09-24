<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Berita;
use App\Models\HargaPangan;
use App\Models\KategoriPangan;
use App\Models\KategoriProduk;
use App\Models\Produk;
use App\Models\User;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $users = User::get();
        $beritas = Berita::get();
        $kategoriproduks = KategoriProduk::get();
        $produks = Produk::get();
        $kategoripangans = KategoriPangan::get();
        $hargapangans = HargaPangan::get();

        return view('admin.index', compact(
            'users',
            'beritas',
            'kategoriproduks',
            'produks',
            'kategoripangans',
            'hargapangans'
        ));
    }
}
