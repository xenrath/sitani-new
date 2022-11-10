<?php

namespace App\Http\Controllers;

use App\Models\GambarProduk;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class GambarProdukController extends Controller
{
    public function hapus_gambar($id)
    {
        $gambarproduk =  GambarProduk::find($id);
        Storage::disk('local')->delete('public/uploads/' . $gambarproduk->gambar);
        $gambarproduk->delete();
        return back()->with('status', 'Gambar dihapus!');
    }
}
