<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\HargaPangan;
use App\Models\Pangan;
use Illuminate\Http\Request;

class RiwayatPanganController extends Controller
{
    public function index()
    {
        $pangans = Pangan::paginate(5);
        return view('admin.riwayat-pangan.index', compact('pangans'));
    }

    public function show($id)
    {
        $pangan = Pangan::where('id', $id)->first();
        $hargapangans = HargaPangan::where('pangan_id', $pangan->id)->get();
        return view('admin.riwayat-pangan.show', compact('pangan', 'hargapangans'));
    }

    public function download($id)
    {
        $pangan = Pangan::where('id', $id)->first();
        $file = public_path('storage/uploads/' . $pangan->file);
        return response()->download($file);
    }
}
