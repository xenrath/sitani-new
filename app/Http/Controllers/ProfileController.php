<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class ProfileController extends Controller
{
    public function index()
    {
        $user = auth()->user();
        return view('profile.index', compact('user'));
    }

    public function update(Request $request)
    {
        $user = auth()->user();

        if ($user->foto) {
            $validator = Validator::make($request->all(), [
                'nama' => 'required',
                'telp' => 'required|unique:users,telp,' . $user->id,
                'alamat' => 'required',
                'foto' => 'nullable|image|mimes:jpeg,jpg,png|max:2048',
            ], [
                'nama.required' => 'Nama lengkap tidak boleh kosong!',
                'telp.required' => 'Nomor telepon tidak boleh kosong!',
                'telp.unique' => 'Nomor telepon sudah digunakan!',
                'alamat.required' => 'Alamat tidak boleh kosong!',
                'foto.image' => 'Foto yang dimasukan salah!',
            ]);
        } else {
            $validator = Validator::make($request->all(), [
                'nama' => 'required',
                'telp' => 'required|unique:users,telp,' . $user->id,
                'alamat' => 'required',
                'foto' => 'required|image|mimes:jpeg,jpg,png|max:2048',
            ], [
                'nama.required' => 'Nama lengkap tidak boleh kosong!',
                'telp.required' => 'Nomor telepon tidak boleh kosong!',
                'telp.unique' => 'Nomor telepon sudah digunakan!',
                'alamat.required' => 'Alamat tidak boleh kosong!',
                'foto.required' => 'Foto harus ditambahkan!',
                'foto.image' => 'Foto yang ditambahkan salah!',
            ]);
        }

        if ($request->password) {
            $validator = Validator::make($request->all(), [
                'password' => 'confirmed',
            ], [
                'password.confirmed' => 'Konfirmasi password tidak sesuai!',
            ]);
        }

        if ($validator->fails()) {
            $error = $validator->errors()->all();
            return back()->withInput()->with('error', $error);
        }

        if ($request->foto) {
            Storage::disk('local')->delete('public/uploads/' . $user->foto);
            $foto = str_replace(' ', '', $request->foto->getClientOriginalName());
            $namafoto = "user/" . date('YmdHis') . "." . $foto;
            $request->foto->storeAs('public/uploads', $namafoto);
        } else {
            $namafoto = $user->foto;
        }

        if ($request->password) {
            $password = bcrypt($request->password);
        } else {
            $password = $user->password;
        }

        User::where('id', $user->id)
            ->update([
                'nama' => $request->nama,
                'telp' => $request->telp,
                'alamat' => $request->alamat,
                'foto' => $namafoto,
                'password' => $password
            ]);

        return back()->with('success', 'Berhasil memperbarui Profile');
    }
}
