<?php

namespace App\Http\Controllers\Petani;

use App\Http\Controllers\Controller;
use App\Models\Produk;
use App\Models\Transaksi;
use Dompdf\Dompdf;

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

    public function cetak_pdf($id)
    {
        $awal = date("Y-m-d");
        $akhir = "2023-04-29";
        
        $user = auth()->user();
        $cetakpdf = Transaksi::whereHas('produk', function ($query) use ($user) {
            $query->where('user_id', $user->id);
        })->where('id', $id)->first();

        $html = view('petani.transaksi.cetak-pdf', compact('cetakpdf','awal','akhir'));

        $dompdf = new Dompdf();
        $dompdf->loadHtml($html);
        $dompdf->setPaper('A4','landscape');
        $dompdf->render();
        $dompdf->stream();
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