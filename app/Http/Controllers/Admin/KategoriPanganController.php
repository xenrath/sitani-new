<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\KategoriPangan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class KategoriPanganController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $kategoripangans = KategoriPangan::paginate(5);
        return view('admin.kategori-pangan.index', compact('kategoripangans'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.kategori-pangan.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'kategori' => 'required|unique:kategori_pangans',
            'nama' => 'required',
        ], [
            'kategori.required' => 'Kategori pangan tidak boleh kosong!',
            'kategori.unique' => 'Kategori pangan sudah digunakan!',
            'nama.required' => 'Nama pangan tidak boleh kosong!'
        ]);

        if ($validator->fails()) {
            $error = $validator->errors()->all();
            return back()->withInput()->with('status', $error);
        }

        KategoriPangan::create($request->all());
        return redirect('admin/kategori-pangan')->with('status', 'Berhasil menambahkan Kategori harga');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $kategoripangan = KategoriPangan::where('id', $id)->first();

        return view('admin.kategori-pangan.show', compact('kategoripangan'));
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $kategoripangan = KategoriPangan::where('id', $id)->first();

        return view('admin.kategori-pangan.edit', compact('kategoripangan'));
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
        $validator = Validator::make($request->all(), [
            'kategori' => 'required|unique:kategori_pangans,kategori,' . $id,
            'nama' => 'required',
        ], [
            'kategori.required' => 'Kategori pangan tidak boleh kosong!',
            'kategori.unique' => 'Kategori pangan sudah digunakan!',
            'nama.required' => 'Nama pangan tidak boleh kosong!'
        ]);

        if ($validator->fails()) {
            $error = $validator->errors()->all();
            return back()->withInput()->with('status', $error);
        }

        KategoriPangan::where('id', $id)->update([
            'kategori' => $request->kategori,
            'nama' => $request->nama,
        ]);

        return redirect('admin/kategori-pangan')->with('status', 'Berhasil mengubah Kategori Pangan');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $kategoripangan = KategoriPangan::find($id);
        $kategoripangan->delete();
        return back()->with('status', 'Berhasil menghapus Kategori Pangan');
    }
}
