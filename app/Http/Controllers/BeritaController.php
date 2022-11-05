<?php

namespace App\Http\Controllers;

use App\Models\Berita;
use Illuminate\Http\Request;
use Carbon\Carbon;

class BeritaController extends Controller
{
    public function index()
    {
        $beritas = Berita::paginate(3);
        return view('berita.index', compact('beritas'));
    }

    public function create()
    {
        return view('berita.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'judul' => 'required',
            'isi' => 'required',
        ], [
            'judul.required' => 'Pilih judul terlebih dahulu!',
            'isi' => 'Masukkan isi berita !'
        ]);
        $now = Carbon::now()->format('d-m-y');

        Berita::create(array_merge($request->all(), [
            'date' => $now
        ]));
        return redirect('berita')->with('status', 'Berhasil menambahkan berita');
    }

    public function show($id)
    {
        $berita = Berita::where('id', $id)->first();
        return view('berita.show', compact('berita'));
    }
    public function edit($id)
    {
        $berita = Berita::where('id', $id)->first();
        return view('berita.edit', compact('berita'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'judul' => 'required',
            'isi' => 'required',
        ], [
            'judul.required' => 'judul tidak boleh kosong!',
            'isi.required' => 'isi tidak boleh kosong!',
        ]);

        Berita::where('id', $id)->update([
            'judul' => $request->judul,
            'isi' => $request->isi,
        ]);

        return redirect('berita')->with('status', 'Berhasil mengubah Kategori berita');
    }

    public function destroy($id)
    {
        $berita = Berita::find($id);
        $berita->delete();
        return redirect('berita')->with('status', 'Berhasil menghapus Berita');
    }
}

