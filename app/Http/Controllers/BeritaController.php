<?php

namespace App\Http\Controllers;

use App\Models\Berita;
use App\Models\KategoriPangan;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\Storage;


class BeritaController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(Request $request)
    {
        if (auth()->user()->isAdmin()) {
            $beritas = Berita::paginate(2);
            $filterKeyword = $request->get('keyword');
            if ($filterKeyword) {
                $beritas = Berita::where('judul', 'LIKE', "%$filterKeyword%")->paginate(2);
            }
            return view('berita.index', compact('beritas'));
        } else {
            $semuas = Berita::get();
            // $berases = Berita::where('judul', 'like', '%beras%')
            //     ->orWhere('isi', 'like', '%beras%')
            //     ->get();
            // $cabais = Berita::where('judul', 'like', '%cabai%')
            //     ->orWhere('isi', 'like', '%cabai%')
            //     ->get();
            // $jagungs = Berita::where('judul', 'like', '%jagung%')
            //     ->orWhere('isi', 'like', '%jagung%')
            //     ->get();
            // $padis = Berita::where('judul', 'like', '%padi%')
            //     ->orWhere('isi', 'like', '%padi%')
            //     ->get();

            $kategoripangans = KategoriPangan::get();

            return view('berita.index', compact('semuas', 'kategoripangans'));
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
            'gambar' => 'required|nullable|image|mimes:jpeg,jpg,png|max:2048',
        ], [
            'judul.required' => 'Pilih judul terlebih dahulu!',
            'isi' => 'Masukkan isi berita !',
            'gambar' => 'Masukkan gambar !'
        ]);
        $now = Carbon::now()->format('d-m-y');

        $fileName = '';
        if ($request->file('gambar')->isValid()) {
            $gambar = $request->file('gambar');
            $extention = $gambar->getClientOriginalExtension();
            $fileName = "berita/" . date('ymdHis') . "." . $extention;
            $upload_path = 'public/storage/uploads/berita';
            $request->file('gambar')->move($upload_path, $fileName);
            $input['gambar'] = $fileName;
        }

        Berita::create(array_merge($request->all(), [
            'date' => $now,
            'gambar' => $fileName,
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

    public function update(Request $request, Berita $berita)
    {
        $request->validate([
            'judul' => 'required',
            'isi' => 'required',
            'gambar' => 'sometimes|nullable|image|mimes:jpeg,jpg,png|max:2048',
        ], [
            'judul.required' => 'judul tidak boleh kosong!',
            'isi.required' => 'isi tidak boleh kosong!',
        ]);

        if ($request->gambar) {
            Storage::disk('local')->delete('public/uploads/' . $berita->gambar);
            $gambar = str_replace(' ', '', $request->gambar->getClientOriginalName());
            $namaGambar = "berita/" . date('YmdHis') . "." . $gambar;
            $request->gambar->storeAs('public/uploads', $namaGambar);
        } else {
            $namaGambar = $berita->gambar;
        }
        Berita::where('id', $berita->id)
            ->update([
                'judul' => $request->judul,
                'isi' => $request->isi,
                'gambar' => $namaGambar,
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