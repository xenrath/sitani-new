<?php

namespace App\Http\Controllers;

use App\Models\Berita;
use App\Models\HargaPangan;
use App\Models\KategoriPangan;
use App\Models\KategoriProduk;
use App\Models\Pangan;
use App\Models\Produk;
use App\Models\User;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    // public function __construct()
    // {
    //     $this->middleware('auth');
    // }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        if (auth()->check() && auth()->user()->isAdmin())
        {
            return redirect('dashboard');
        }

        $pangan = Pangan::latest()->first();
        $hargapangans = HargaPangan::where('pangan_id', $pangan->id)->paginate(5);

        return view('home', compact('pangan', 'hargapangans'));
    }

    public function dashboard()
    {
        $users = User::get();
        $beritas = Berita::get();
        $kategoriproduks = KategoriProduk::get();
        $produks = Produk::get();
        $kategoripangans = KategoriPangan::get();
        $hargapangans = HargaPangan::get();

        return view('dashboard', compact(
            'users',
            'beritas',
            'kategoriproduks',
            'produks',
            'kategoripangans',
            'hargapangans'
        ));
    }
}
