<?php

namespace App\Http\Controllers\Tengkulak;

use App\Http\Controllers\Controller;
use App\Models\Produk;
use App\Models\Transaksi;
use Dompdf\Dompdf;

class TransaksiController extends Controller
{
    public function index()
    {
        $user = auth()->user();
        $menunggus = Transaksi::whereHas('tengkulak', function ($query) use ($user) {
            $query->where('tengkulak_id', $user->id);
        })->where('status', 'menunggu')->get();
        $riwayats = Transaksi::whereHas('tengkulak', function ($query) use ($user) {
            $query->where('tengkulak_id', $user->id);
        })->where('status', '!=', 'menunggu')->get();

        return view('tengkulak.transaksi.index', compact('menunggus', 'riwayats'));
    }

    public function cetak_pdf($id)
    {
        $awal = date("Y-m-d");
        $akhir = "2023-04-29";
        
        $user = auth()->user();
        $cetakpdf = Transaksi::whereHas('tengkulak', function ($query) use ($user) {
            $query->where('tengkulak_id', $user->id);
        })->where('id', $id)->first();

        $html = view('tengkulak.transaksi.cetak-pdf', compact('cetakpdf','awal','akhir'));

        $dompdf = new Dompdf();
        $dompdf->loadHtml($html);
        $dompdf->setPaper('A4', 'landscape');
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
}