<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
   public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nama' => 'required',
            'telp' => 'required|unique:users',
            'alamat' => 'required',
            'role' => 'required',
            'password' => 'required|confirmed'
        ], [
            'nama.required' => 'Nama lengkap harus diisi!',
            'telp.required' => 'Nomor telepon harus diisi!',
            'telp.unique' => 'Nomor telepon sudah digunakan!',
            'alamat.required' => 'Alamat harus diisi!',
            'role.required' => 'Role harus dipilih!',
            'password.required' => 'Password harus diisi!',
            'password.confirmed' => 'Konfirmasi password tidak sesuai!'
        ]);

        if ($validator->fails()) {
            $error = $validator->errors()->all();
            return back()->withInput()->with('error', $error);
        }

        User::create(array_merge($request->all(), [
            'password' => bcrypt($request->password),
        ]));

        return back()->with('success', 'Berhasil melakukan pendaftaran');
    }
}
