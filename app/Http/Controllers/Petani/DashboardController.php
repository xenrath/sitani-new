<?php

namespace App\Http\Controllers\Petani;

use App\Http\Controllers\Controller;
use App\Models\Berita;
use App\Models\HargaPangan;
use App\Models\KategoriPangan;
use App\Models\KategoriProduk;
use App\Models\Pangan;
use App\Models\Produk;
use App\Models\User;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $pangans = Pangan::orderByDesc('created_at')->paginate(1);

        return view('home', compact('pangans'));
    }
}
