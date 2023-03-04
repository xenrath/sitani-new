<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Imports\HargaPanganImport;
use App\Models\HargaPangan;
use App\Models\Pangan;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\Validator;

class HargaPanganController extends Controller
{
    public function index()
    {
        $pangan = Pangan::latest()->first();
        $hargapangans = HargaPangan::where('pangan_id', $pangan->id)->paginate(5);
        return view('admin.harga-pangan.index', compact('pangan', 'hargapangans'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // $kategorihargas = KategoriPangan::all();
        // return view('admin.harga-pangan.create', compact('kategorihargas'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'kategori_id' => 'required',
            'namapangan' => 'required',
            'harga' => 'required',
        ], [
            'kategori_id.required' => 'Pilih kategori terlebih dahulu!',
            'namapangan' => 'Masukkan nama pangan!',
            'harga' => 'Masukkan harga!'
        ]);

        $now = Carbon::now()->format('d-m-y');

        if ($request->harga < 0) {
            return back()->with('error', 'GAGAL ! Masukan harga dengan benar!');
        }

        HargaPangan::create(array_merge($request->all(), [
            'tanggal' => $now
        ]));

        return redirect('admin/harga-pangan')->with('status', 'Berhasil menambahkan harga pangan');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(HargaPangan $hargapangan)
    {
        return view('admin.harga-pangan.show', compact('hargapangan'));
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        // $kategorihargas = KategoriHarga::all();
        // $hargapangan = HargaPangan::where('id', $id)->first();
        // return view('admin.harga-pangan.edit', compact('hargapangan', 'kategorihargas'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'kategori_id' => 'required',
            'namapangan' => 'required',
            'harga' => 'required',
        ], [
            'kategori_id.required' => 'kategori tidak boleh kosong!',
            'namapangan.required' => 'nama pangan tidak boleh kosong!',
            'harga.required' => 'harga tidak boleh kosong!',
        ]);

        HargaPangan::where('id', $id)->update([
            'kategori_id' => $request->kategori_id,
            'namapangan' => $request->namapangan,
            'harga' => $request->harga,
        ]);

        return redirect('admin/harga-pangan')->with('status', 'Berhasil mengubah harga pangan');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $hargapangan = HargaPangan::find($id);
        $hargapangan->delete();
        return redirect('admin/harga-pangan')->with('status', 'Berhasil menghapus harga pangan');
    }

    public function import(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'file' => 'required',
        ], [
            'file.required' => 'File harus ditambahkan!',
        ]);

        if ($validator->fails()) {
            $error = $validator->errors()->all();
            return back()->with('error', $error[0]);
        }

        $file = $request->file('file');
        $nama = str_replace(' ', '', $file->getClientOriginalName());
        $namafile = 'file/' . date('mYdHs') . rand(1, 10) . '_' . $nama;
        $file->storeAs('public/uploads', $namafile);

        $pangan = Pangan::create(array('file' => $namafile));

        if ($pangan) {
            $import = new HargaPanganImport($pangan->id);
            $import->import($file);

            // dd($import->failures());

            if ($import->failures()->isNotEmpty()) {
                return back()->withFailures($import->failures());
            } else {
                return back()->with('status', 'Berhasil mengimport Harga Pangan');
            }
        }

        return back();
    }

    public function export()
    {
        $file = public_path('storage/uploads/format/format_hargapangan.xlsx');
        return response()->download($file);
    }
}
