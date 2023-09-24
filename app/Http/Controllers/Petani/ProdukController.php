<?php

namespace App\Http\Controllers\Petani;

use App\Http\Controllers\Controller;
use App\Models\GambarProduk;
use App\Models\KategoriProduk;
use Illuminate\Http\Request;
use App\Models\Produk;
use App\Models\Transaksi;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class ProdukController extends Controller
{
    public function index(Request $request)
    {
        $kategori_id = $request->kategori_id;
        $kategoriproduk = KategoriProduk::where('id', $kategori_id)->first();

        $produks = Produk::where('user_id', auth()->user()->id)->with('gambar')->get();

        // return response($produks);
        $kategoriproduks = KategoriProduk::get();

        return view('petani.produk.index', compact('produks', 'kategoriproduk', 'kategoriproduks'));
    }

    public function create()
    {
        $kategoriproduks = KategoriProduk::all();
        return view('petani.produk.create', compact('kategoriproduks'));
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nama' => 'required',
            'kategori_id' => 'required',
            'harga' => 'required|gt:0',
            'stok' => 'required',
            'latitude' => 'required',
            // 'longitude' => 'required',
            'deskripsi' => 'required',
            'gambar' => 'required',
        ], [
            'nama.required' => 'Nama produk tidak boleh kosong!',
            'kategori_id.required' => 'Kategori harus dipilih!',
            'harga.required' => 'Harga tidak boleh kosong!',
            'harga.gt' => 'Harga yang dimasukan salah!',
            'stok.required' => 'Stok tidak boleh kosong!',
            'latitude.required' => 'Silakan pilih lokasi!',
            // 'longitude.required' => 'Longitude tidak boleh kosong!',
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

        return redirect('petani/produk')->with('status', 'Berhasil menambahkan Produk');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Produk $produk)
    {
        return view('petani.produk.show', compact('produk'));
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

        return view('petani.produk.edit', compact('produk', 'kategoriproduks', 'gambarproduks'));
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
            'harga' => 'required|gt:0',
            'stok' => 'required',
            'latitude' => 'required',
            // 'longitude' => 'required',
            'deskripsi' => 'required',
        ], [
            'nama.required' => 'Nama produk tidak boleh kosong!',
            'kategori_id.required' => 'Kategori harus dipilih!',
            'harga.required' => 'Harga tidak boleh kosong!',
            'harga.gt' => 'Harga yang dimasukan salah!',
            'stok.required' => 'Stok tidak boleh kosong!',
            'latitude.required' => 'Pilih lokasi!',
            // 'longitude.required' => 'Stok tidak boleh kosong!',
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
                'latitude' => $request->latitude,
                'longitude' => $request->longitude,
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

        return redirect('petani/produk')->with('status', 'Berhasil mengubah produk');
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
        return redirect('petani/produk')->with('status', 'Berhasil menghapus produk');
    }

    public function konfirmasi(Request $request, $id)
    {
        $produk = Produk::where('id', $id)->first();
        $user = auth()->user();

        $jumlah = $request->jumlah;
        $total = $produk->harga * $jumlah;

        $basic = "Permisi, Saya " . $user->nama . " dari " . $user->alamat .
            ".%0ASaya tertarik dengan produk " . $produk->nama . " (" . $produk->kategori->nama .
            ") Anda ";

        if ($produk->kategori->nama == 'Biasa') {
            $text = $basic . "sejumlah " . $jumlah . "Kg, dengan harga " . $total;
        } else {
            $text = $basic . "dengan harga " . $produk->harga;
        }

        $stok = $produk->stok - $request->jumlah;

        Produk::where('id', $produk->id)->update([
            'stok' => $stok
        ]);

        Transaksi::create([
            'tengkulak_id' => $user->id,
            'produk_id' => $produk->id,
            'jumlah' => $jumlah,
            'status' => 'menunggu'
        ]);

        return redirect()->away('https://web.whatsapp.com/send?phone=+6285328481969&text=' . $text);
    }
}