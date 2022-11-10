<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Kategoriproduk;
use Illuminate\Http\Request;

class KategoriprodukController extends Controller
{
    public function index()
    {
        $kategoriproduks = Kategoriproduk::paginate(3);
        return view('kategoriproduk.index', compact('kategoriproduks'));
    }

    public function create()
    {
        return view('kategoriproduk.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required'
        ], [
            'nama.required' => 'Produk tidak boleh kosong!'
        ]);

        Kategoriproduk::create($request->all());

        return redirect('kategoriproduk')->with('status', 'Berhasil menambahkan kategori produk');
    }

    public function show(Kategoriproduk $kategoriproduk)
    {
        return view('kategoriproduk.show', compact('kategoriproduk'));
    }

    public function edit(Kategoriproduk $kategoriproduk)
    {
        return view('kategoriproduk.edit', compact('kategoriproduk'));
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

        return redirect('kategoriproduk')->with('status', 'Berhasil mengubah Kategori produk');
    }

    public function destroy($id)
    {
        $produk = Kategoriproduk::find($id);
        $produk->delete();
        return redirect('kategoriproduk')->with('status', 'Berhasil menghapus Kategori produk');
    }
}
