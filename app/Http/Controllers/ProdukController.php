<?php

namespace App\Http\Controllers;

use App\Models\GambarProduk;
use App\Models\KategoriProduk;
use Illuminate\Http\Request;
use App\Models\Produk;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class ProdukController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(Request $request)
    {
        $kategori_id = $request->kategori_id;
        $kategoriproduk = KategoriProduk::where('id', $kategori_id)->first();

        $keyword = $request->keyword;

        if ($keyword != "" && $kategori_id != "") {
            $produks = Produk::where([
                ['kategori_id', $kategori_id],
                ['nama', 'like', "%$keyword%"],
            ])->with('gambar')->get();
        } elseif ($keyword != "" && $kategori_id == "") {
            $produks = Produk::where('nama', 'like', "%$keyword%")->with('gambar')->get();
        } elseif ($keyword == "" && $kategori_id != "") {
            $produks = Produk::where('kategori_id', $kategori_id)->with('gambar')->get();
        } else {
            $produks = Produk::with('gambar')->get();
        }

        // return response($produks);
        $kategoriproduks = KategoriProduk::get();
        return view('produk.produk.index', compact('produks', 'kategoriproduk', 'kategoriproduks'));
    }

    public function create()
    {
        $kategoriproduks = KategoriProduk::all();
        return view('produk.produk.create', compact('kategoriproduks'));
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nama' => 'required',
            'kategori_id' => 'required',
            'harga' => 'required|gt:0',
            'stok' => 'required',
            'deskripsi' => 'required',
            'gambar' => 'required',
        ], [
            'nama.required' => 'Nama produk tidak boleh kosong!',
            'kategori_id.required' => 'Kategori harus dipilih!',
            'harga.required' => 'Harga tidak boleh kosong!',
            'harga.gt' => 'Harga yang dimasukan salah!',
            'stok.required' => 'Stok tidak boleh kosong!',
            'deskripsi.required' => 'Deskripsi tidak boleh kosong!',
            'gambar.required' => 'Gambar harus ditambahkan!',
        ]);

        if ($validator->fails()) {
            $error = $validator->errors()->all();
            return back()->withInput()->with('status', $error);
        }

        $produk = Produk::create(array_merge($request->all(), [
            'user_id' => auth()->user()->id
        ]));

        if ($request->has('gambar')) {
            $gambars = $request->file('gambar');

            foreach ($gambars as $gambar) {
                $name = str_replace(' ', '', $gambar->getClientOriginalName());
                $namagambar = 'produk/' . date('mYdHs') . random_int(1, 10) . '_' . $name;
                $gambar->storeAs('public/uploads', $namagambar);

                GambarProduk::create([
                    'produk_id' => $produk->id,
                    'gambar' => $namagambar
                ]);
            }
        }

        return redirect('produk/produk')->with('status', 'Berhasil menambahkan Produk');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Produk $produk)
    {
        return view('produk.produk.show', compact('produk'));
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

        return view('produk.produk.edit', compact('produk', 'kategoriproduks', 'gambarproduks'));
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
        $validator = Validator::make($request->all(), [
            'nama' => 'required',
            'kategori_id' => 'required',
            'harga' => 'required|gt',
            'stok' => 'required',
            'deskripsi' => 'required',
        ], [
            'nama.required' => 'Nama produk tidak boleh kosong!',
            'kategori_id.required' => 'Kategori harus dipilih!',
            'harga.required' => 'Harga tidak boleh kosong!',
            'harga.gt' => 'Harga yang dimasukan salah!',
            'stok.required' => 'Stok tidak boleh kosong!',
            'deskripsi.required' => 'Deskripsi tidak boleh kosong!',
            'gambar.required' => 'Gambar harus ditambahkan!',
        ]);

        if ($validator->fails()) {
            $error = $validator->errors()->all();
            return back()->withInput()->with('status', $error);
        }

        Produk::where('id', $produk->id)
            ->update([
                'nama' => $request->nama,
                'kategori_id' => $request->kategori_id,
                'harga' => $request->harga,
                'stok' => $request->stok,
                'deskripsi' => $request->deskripsi
            ]);

        if ($request->has('gambars')) {
            $gambars = $request->file('gambars');

            foreach ($gambars as $gambar) {
                $name = str_replace(' ', '', $gambar->getClientOriginalName());
                $namagambar = 'produk/' . date('mYdHs') . random_int(1, 10) . '_' . $name;
                $gambar->storeAs('public/uploads', $namagambar);

                GambarProduk::create([
                    'produk_id' => $produk->id,
                    'gambar' => $namagambar
                ]);
            }
        }

        return redirect('produk/produk')->with('status', 'Berhasil mengubah produk');
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
        return redirect('produk/produk')->with('status', 'Berhasil menghapus produk');
    }
}
