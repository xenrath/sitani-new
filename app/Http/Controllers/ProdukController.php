<?php

namespace App\Http\Controllers;

use App\Models\GambarProduk;
use App\Models\KategoriHarga;
use App\Models\Kategoriproduk;
use Illuminate\Http\Request;
use App\Models\Produk;
use Illuminate\Support\Facades\Storage;

class ProdukController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $produks = Produk::with('gambar')->get();

        // return response($produks);

        return view('produk.index', compact('produks'));
    }

    public function create()
    {
        $kategoriproduks = Kategoriproduk::all();
        return view('produk.create', compact('kategoriproduks'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required',
            'harga' => 'required',
            'kategori_id' => 'required',
            'stok' => 'required',
            'deskripsi' => 'required',
        ], [
            'nama.required' => 'Masukan nama!',
            'harga.required' => 'Masukkan harga !',
            'gambar.required' => 'Masukkan gambar !',
            'kategori_id.required' => 'Pilih kategori !',
            'stok.required' => 'Masukkan stok !',
            'deskripsi.required' => 'Masukkan deskripsi !',
        ]);

        if ($request->harga < 0) {
            return back()->with('error', 'Gagal! Masukan nominal harga dengan benar');
        }

        $produk = Produk::create(array_merge($request->all(), [
            'user_id' => auth()->user()->id
        ]));

        if ($request->has('gambars')) {
            $gambars = $request->file('gambars');

            foreach ($gambars as $gambar) {
                $name = str_replace(' ', '', $gambar->getClientOriginalName());
                $namagambar = 'produk/' . date('mYdHs') . rand(1, 10) . '_' . $name;
                $gambar->storeAs('public/uploads', $namagambar);

                GambarProduk::create([
                    'produk_id' => $produk->id,
                    'gambar' => $namagambar
                ]);
            }
        }

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
        $gambarproduks = GambarProduk::where('produk_id', $produk->id)->get();

        return view('produk.edit', compact('produk', 'kategoriproduks', 'gambarproduks'));
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
        ], [
            'nama.required' => 'Masukan nama!',
            'harga.required' => 'Masukkan harga !',
            'kategori_id.required' => 'Pilih kategori !',
            'stok.required' => 'Masukkan stok !',
            'deskripsi.required' => 'Masukkan deskripsi !',
        ]);

        if ($request->harga < 0) {
            return back()->with('error', 'Gagal! Masukan nominal harga dengan benar');
        }

        Produk::where('id', $produk->id)
            ->update([
                'nama' => $request->nama,
                'harga' => $request->harga,
                'kategori_id' => $request->kategori_id,
                'stok' => $request->stok,
                'deskripsi' => $request->deskripsi
            ]);

        if ($request->has('gambars')) {
            $gambars = $request->file('gambars');

            foreach ($gambars as $gambar) {
                $name = str_replace(' ', '', $gambar->getClientOriginalName());
                $namagambar = 'produk/' . date('mYdHs') . rand(1, 10) . '_' . $name;
                $gambar->storeAs('public/uploads', $namagambar);

                GambarProduk::create([
                    'produk_id' => $produk->id,
                    'gambar' => $namagambar
                ]);
            }
        }

        return redirect('produk')->with('status', 'Berhasil mengubah produk');
    }

    public function destroy($id)
    {
        $produk = Produk::find($id);
        $gambarproduks = GambarProduk::where('produk_id', $produk->id)->get();

        foreach ($gambarproduks as $gambarproduk) {
            Storage::disk('local')->delete('public/uploads/' . $gambarproduk->gambar);
            $gambarproduk->delete();
        }
        
        $produk->delete();
        return redirect('produk')->with('status', 'Berhasil menghapus produk');
    }
}
