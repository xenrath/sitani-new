<?php

namespace App\Http\Controllers\Petani;

use App\Http\Controllers\Controller;
use App\Models\GambarProduk;
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
