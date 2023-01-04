<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\KategoriProduk;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

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
        $validator = Validator::make($request->all(), [
            'nama' => 'required'
        ], [
            'nama.required' => 'Nama kategori tidak boleh kosong!'
        ]);

        if ($validator->fails()) {
            $error = $validator->errors()->all();
            return back()->withInput()->with('status', $error);
        }

        KategoriProduk::create($request->all());

        return redirect('produk/kategori')->with('status', 'Berhasil menambahkan Kategori Produk');
    }

    public function show($id)
    {
        // 
    }

    public function edit($id)
    {
        $kategoriproduk = KategoriProduk::where('id', $id)->first();

        return view('produk.kategori.edit', compact('kategoriproduk'));
    }

    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'nama' => 'required'
        ], [
            'nama.required' => 'Nama kategori tidak boleh kosong!'
        ]);

        if ($validator->fails()) {
            $error = $validator->errors()->all();
            return back()->withInput()->with('status', $error);
        }

        Kategoriproduk::where('id', $id)->update([
            'nama' => $request->nama
        ]);

        return redirect('produk/kategori')->with('status', 'Berhasil mengubah Kategori produk');
    }

    public function destroy($id)
    {
        $produk = Kategoriproduk::find($id);
        $produk->delete();
        return back()->with('status', 'Berhasil menghapus Kategori produk');
    }
}
