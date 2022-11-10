<?php

namespace App\Http\Controllers;

use App\Models\KategoriHarga;
use Illuminate\Http\Request;

class KategorihargaController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $kategorihargas = KategoriHarga::paginate(3);
        return view('kategoriharga.index', compact('kategorihargas'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('kategoriharga.create');
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
            'kategori' => 'required',
            'nama' => 'required',
        ], [
            'kategori.required' => 'Pilih kategori terlebih dahulu!',
            'nama' => 'Masukkan isi nama !'
        ]);

        KategoriHarga::create($request->all());
        return redirect('kategoriharga')->with('status', 'Berhasil menambahkan Kategori harga');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(KategoriHarga $kategoriharga)
    {
        return view('kategoriharga.show', compact('kategoriharga'));
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $kategoriharga = KategoriHarga::where('id', $id)->first();
        return view('kategoriharga.edit', compact('kategoriharga'));
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
            'kategori' => 'required',
            'nama' => 'required',
        ], [
            'kategori.required' => 'kategori tidak boleh kosong!',
            'nama.required' => 'nama tidak boleh kosong!',
        ]);

        KategoriHarga::where('id', $id)->update([
            'kategori' => $request->kategori,
            'nama' => $request->nama,
        ]);

        return redirect('kategoriharga')->with('status', 'Berhasil mengubah Kategori harga');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $kategoriharga = KategoriHarga::find($id);
        $kategoriharga->delete();
        return redirect('kategoriharga')->with('status', 'Berhasil menghapus Kategori harga');
    }
}