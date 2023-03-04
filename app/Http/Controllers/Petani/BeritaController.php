<?php

namespace App\Http\Controllers\Petani;

use App\Http\Controllers\Controller;
use App\Models\Berita;
use App\Models\KategoriPangan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class BeritaController extends Controller
{
    public function index(Request $request)
    {
        $semuas = Berita::get();
        $kategoripangans = KategoriPangan::get();

        return view('petani.berita.index', compact('semuas', 'kategoripangans'));
    }

    public function create()
    {
        $kategoripangans = KategoriPangan::get();

        return view('petani.berita.create', compact('kategoripangans'));
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'kategoripangan_id' => 'required',
            'judul' => 'required',
            'isi' => 'required',
            'gambar' => 'required|image|mimes:jpeg,jpg,png|max:2048',
        ], [
            'kategoripangan_id.required' => 'Kategori pangan harus dipilih!',
            'judul.required' => 'Judul harus diisi!',
            'isi.required' => 'Isi berita harus diisi!',
            'gambar.required' => 'Gambar harus ditambahkan!',
            'gambar.image' => 'Gambar yang dimasukan salah!'
        ]);

        if ($validator->fails()) {
            $error = $validator->errors()->all();
            return back()->withInput()->with('status', $error);
        }

        $nama = str_replace(' ', '', $request->gambar->getClientOriginalName());
        $namagambar = 'berita/' . date('mYdHs') . random_int(1, 10) . '_' . $nama;
        $request->gambar->storeAs('public/uploads', $namagambar);

        Berita::create(array_merge($request->all(), [
            'gambar' => $namagambar,
        ]));

        return redirect('berita')->with('status', 'Berhasil menambahkan Berita');
    }

    public function show($id)
    {
        $berita = Berita::where('id', $id)->first();

        return view('petani.berita.show', compact('berita'));
    }

    public function edit($id)
    {
        $berita = Berita::where('id', $id)->first();
        $kategoripangans = KategoriPangan::get();

        return view('petani.berita.edit', compact('berita', 'kategoripangans'));
    }

    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'kategoripangan_id' => 'required',
            'judul' => 'required',
            'isi' => 'required',
            'gambar' => 'nullable|image|mimes:jpeg,jpg,png|max:2048',
        ], [
            'kategoripangan_id.required' => 'Kategori pangan harus dipilih!',
            'judul.required' => 'judul tidak boleh kosong!',
            'isi.required' => 'isi tidak boleh kosong!',
            'gambar.image' => 'Gambar yang dimasukan salah!'
        ]);

        if ($validator->fails()) {
            $error = $validator->errors()->all();
            return back()->withInput()->with('status', $error);
        }

        $berita = Berita::findOrFail($id);

        if ($request->gambar) {
            Storage::disk('local')->delete('public/uploads/' . $berita->gambar);
            $gambar = str_replace(' ', '', $request->gambar->getClientOriginalName());
            $namagambar = "berita/" . date('YmdHis') . "." . $gambar;
            $request->gambar->storeAs('public/uploads', $namagambar);
        } else {
            $namagambar = $berita->gambar;
        }

        Berita::where('id', $berita->id)
            ->update([
                'kategoripangan_id' => $request->kategoripangan_id,
                'judul' => $request->judul,
                'isi' => $request->isi,
                'gambar' => $namagambar,
            ]);

        return redirect('berita')->with('status', 'Berhasil memperbarui Berita');
    }

    public function destroy($id)
    {
        $berita = Berita::find($id);
        Storage::disk('local')->delete('public/uploads/' . $berita->gambar);
        $berita->delete();

        return redirect('berita')->with('status', 'Berhasil menghapus Berita');
    }
}
