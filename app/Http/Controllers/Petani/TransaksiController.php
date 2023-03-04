<?php

namespace App\Http\Controllers\Petani;

use App\Http\Controllers\Controller;
use App\Models\Produk;
use App\Models\Transaksi;
use Illuminate\Http\Request;

class TransaksiController extends Controller
{
    public function index()
    {
        $user = auth()->user();
        $menunggus = Transaksi::whereHas('produk', function ($query) use ($user) {
            $query->where('user_id', $user->id);
        })->where('status', 'menunggu')->get();
        $riwayats = Transaksi::whereHas('produk', function ($query) use ($user) {
            $query->where('user_id', $user->id);
        })->where('status', '!=', 'menunggu')->get();

        return view('petani.transaksi.index', compact('menunggus', 'riwayats'));
    }

    public function konfirmasi($id)
    {
        $transaksi = Transaksi::where('id', $id)->first();

        $transaksi->update([
            'status' => 'selesai'
        ]);

        if ($transaksi->produk->stok == '0') {
            $status = false;
        } else {
            $status = true;
        }

        Produk::where('id', $transaksi->id)->update([
            'status' => $status
        ]);

        return back()->with('success', 'Berhasil mengkonfirmasi transaksi');
    }

    public function batalkan($id)
    {
        $transaksi = Transaksi::where('id', $id)->first();

        $transaksi->update([
            'status' => 'gagal'
        ]);

        $stok = $transaksi->produk->stok + $transaksi->jumlah;

        Produk::where('id', $transaksi->id)->update([
            'stok' => $stok
        ]);

        return back()->with('success', 'Berhasil membatalkan transaksi');
    }
}
