<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\KategoriProduk;
use Illuminate\Http\Request;

class KategoriProdukController extends Controller
{
    public function index()
    {
        $kategoriproduks = KategoriProduk::paginate(5);
        return view('produk.kategori.index', compact('kategoriproduks'));
    }

    public function create()
    {
        return view('produk.kategori.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required'
        ], [
            'nama.required' => 'Kategori Produk tidak boleh kosong!'
        ]);

        KategoriProduk::create($request->all());

        return redirect('k_prooduk')->with('status', 'Berhasil menambahkan kategori produk');
    }

    public function show(Kategoriproduk $kategoriproduk)
    {
        return view('kategoriproduk.show', compact('kategoriproduk'));
    }

    public function edit(Kategoriproduk $kategoriproduk)
    {
        return view('produk.kategori.edit', compact('kategoriproduk'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nama' => 'required'
        ], [
            'nama.required' => 'nama tidak boleh kosong!'
        ]);

        Kategoriproduk::where('id', $id)->update([
            'nama' => $request->nama
        ]);

        return redirect('k_produk')->with('status', 'Berhasil mengubah Kategori produk');
    }

    public function destroy($id)
    {
        $produk = Kategoriproduk::find($id);
        $produk->delete();
        return redirect('k_produk')->with('status', 'Berhasil menghapus Kategori produk');
    }
}
