<?php

namespace App\Http\Controllers;

use App\Models\KategoriHarga;
use App\Models\Kategoriproduk;
use Illuminate\Http\Request;
use App\Models\Produk;
use Illuminate\Support\Facades\Storage;

class ProdukController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $produks = Produk::get();
        return view('produk.index', compact('produks'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $kategoriproduks = Kategoriproduk::all();
        return view('produk.create', compact('kategoriproduks'));
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
            'nama' => 'required',
            'harga' => 'required',
            'kategori_id' => 'required',
            'stok' => 'required',
            'deskripsi' => 'required',
            'gambar' => 'required|nullable|image|mimes:jpeg,jpg,png|max:2048',
        ], [
            'nama.required' => 'Masukan nama!',
            'harga.required' => 'Masukkan harga !',
            'gambar.required' => 'Masukkan gambar !',
            'kategori_id.required' => 'Pilih kategori !',
            'stok.required' => 'Masukkan stok !',
            'deskripsi.required' => 'Masukkan deskripsi !',
        ]);

        $fileName = '';
        if ($request->file('gambar')->isValid()) {
            $gambar = $request->file('gambar');
            $extention = $gambar->getClientOriginalExtension();
            $fileName = "produk/" . date('ymdHis') . "." . $extention;
            $upload_path = 'public/storage/uploads/produk';
            $request->file('gambar')->move($upload_path, $fileName);
            $input['gambar'] = $fileName;
        }
        Produk::create(array_merge($request->all(), [
            'gambar' => $fileName,
            'user_id' => ''
        ]));

        return redirect('produk')->with('status', 'Berhasil menambahkan produk');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Produk $produk)
    {
        return view('produk.show', compact('produk'));
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Produk $produk)
    {
        $kategoriproduks = Kategoriproduk::all();
        return view('produk.edit', compact('produk','kategoriproduks'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Produk $produk)
    {
        $request->validate([
            'nama' => 'required',
            'harga' => 'required',
            'kategori_id' => 'required',
            'stok' => 'required',
            'deskripsi' => 'required',
            'gambar' => 'sometimes|nullable|image|mimes:jpeg,jpg,png|max:2048',
        ], [
            'nama.required' => 'Masukan nama!',
            'harga.required' => 'Masukkan harga !',
            'kategori_id.required' => 'Pilih kategori !',
            'stok.required' => 'Masukkan stok !',
            'deskripsi.required' => 'Masukkan deskripsi !',
        ]);

        if ($request->gambar) {
            Storage::disk('local')->delete('public/uploads/' . $produk->gambar);
            $gambar = str_replace(' ', '', $request->gambar->getClientOriginalName());
            $namaGambar = "produk/" . date('YmdHis') . "." . $gambar;
            $request->gambar->storeAs('public/uploads', $namaGambar);
        } else {
            $namaGambar = $produk->gambar;
        }
        Produk::where('id', $produk->id)
            ->update([
                'nama' => $request->nama,
                'harga' => $request->harga,
                'kategori_id' => $request->kategori_id,
                'stok' => $request->stok,
                'deskripsi' => $request->deskripsi,
                'gambar' => $namaGambar,
            ]);
        return redirect('produk')->with('status', 'Berhasil mengubah produk');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $produk = Produk::find($id);
        $produk->delete();
        return redirect('produk')->with('status', 'Berhasil menghapus produk');
    }
}
