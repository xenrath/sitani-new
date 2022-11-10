<?php

namespace App\Http\Controllers;

use App\Models\Berita;
use Illuminate\Http\Request;
use Carbon\Carbon;

class BeritaController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        if (auth()->user()->isAdmin()) {
            $beritas = Berita::paginate(2);

            return view('berita.index', compact('beritas'));
        } else {
            $semuas = Berita::get();
            $berases = Berita::where('judul', 'like', '%beras%')
                ->orWhere('isi', 'like', '%beras%')
                ->get();
            $cabais = Berita::where('judul', 'like', '%cabai%')
                ->orWhere('isi', 'like', '%cabai%')
                ->get();
            $jagungs = Berita::where('judul', 'like', '%jagung%')
                ->orWhere('isi', 'like', '%jagung%')
                ->get();
            $padis = Berita::where('judul', 'like', '%padi%')
                ->orWhere('isi', 'like', '%padi%')
                ->get();

            return view('berita.index', compact('semuas', 'berases', 'cabais', 'jagungs', 'padis'));
        }
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

        return redirect('berita')->with('status', 'Berhasil memperbarui berita');
    }

    public function destroy($id)
    {
        $berita = Berita::find($id);
        $berita->delete();
        return redirect('berita')->with('status', 'Berhasil menghapus Berita');
    }
}
