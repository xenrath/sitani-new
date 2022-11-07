<?php

namespace App\Http\Controllers;

use App\Models\HargaPangan;
use App\Models\KategoriHarga;
use Illuminate\Http\Request;
use Carbon\Carbon;

class HargaPanganController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $hargapangans = HargaPangan::paginate(3);
        return view('hargapangan.index', compact('hargapangans'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $kategorihargas = KategoriHarga::all();
        return view('hargapangan.create', compact('kategorihargas'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'kategori_id' => 'required',
            'namapangan' => 'required',
            'harga' => 'required',
        ], [
            'kategori_id.required' => 'Pilih kategori terlebih dahulu!',
            'namapangan' => 'Masukkan nama pangan !',
            'harga' => 'Masukkan harga !'
        ]);

        $now = Carbon::now()->format('d-m-y');

        HargaPangan::create(array_merge($request->all(), [
            'tanggal' => $now
        ]));
        return redirect('hargapangan')->with('status', 'Berhasil menambahkan harga pangan');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(HargaPangan $hargapangan)
    {
        return view('hargapangan.show', compact('hargapangan'));
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $kategorihargas = KategoriHarga::all();
        $hargapangan = HargaPangan::where('id', $id)->first();
        return view('hargapangan.edit', compact('hargapangan', 'kategorihargas'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'kategori_id' => 'required',
            'namapangan' => 'required',
            'harga' => 'required',
        ], [
            'kategori_id.required' => 'kategori tidak boleh kosong!',
            'namapangan.required' => 'nama pangan tidak boleh kosong!',
            'harga.required' => 'harga tidak boleh kosong!',
        ]);

        HargaPangan::where('id', $id)->update([
            'kategori_id' => $request->kategori_id,
            'namapangan' => $request->namapangan,
            'harga' => $request->harga,
        ]);

        return redirect('hargapangan')->with('status', 'Berhasil mengubah harga pangan');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $hargapangan = HargaPangan::find($id);
        $hargapangan->delete();
        return redirect('hargapangan')->with('status', 'Berhasil menghapus harga pangan');
    }
}
