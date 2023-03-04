<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{

    public function index(Request $request)
    {
        $users = User::paginate(3);
        $filterKeyword = $request->get('keyword');
        if ($filterKeyword) {
            $users = User::where('nama', 'LIKE', "%$filterKeyword%")->paginate(3);
        }
        return view('admin.user.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.user.create');
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
            'role' => 'required',
            'nama' => 'required',
            'telp' => 'required|unique:users',
            'alamat' => 'required',
            'foto' => 'required|image|mimes:jpeg,jpg,png|max:2048',
        ], [
            'role.required' => 'Role harus dipilih!',
            'nama.required' => 'Nama lengkap tidak boleh kosong!',
            'telp.required' => 'Nomor telepon tidak boleh kosong!',
            'telp.unique' => 'Nomor telepon sudah digunakan!',
            'alamat.required' => 'Alamat tidak boleh kosong!',
            'foto.required' => 'Foto harus ditambahkan'
        ]);

        if ($validator->fails()) {
            $error = $validator->errors()->all();
            return back()->withInput()->with('status', $error);
        }

        $nama = str_replace(' ', '', $request->foto->getClientOriginalName());
        $namafoto = 'user/' . date('mYdHs') . random_int(1, 10) . '_' . $nama;
        $request->foto->storeAs('public/uploads', $namafoto);

        User::create(array_merge($request->all(), [
            'password' => bcrypt('12345678'),
            'foto' => $namafoto,
        ]));

        return redirect('admin/user')->with('status', 'Berhasil menambahkan user');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        return view('admin.user.show', compact('user'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = User::where('id', $id)->first();
        return view('admin.user.edit', compact('user'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        if ($user->foto) {
            $validator = Validator::make($request->all(), [
                'nama' => 'required',
                'role' => 'required',
                'telp' => 'required|unique:users,telp,' . $user->id,
                'alamat' => 'required',
                'foto' => 'nullable|image|mimes:jpeg,jpg,png|max:2048',
            ], [
                'role.required' => 'Role harus dipilih!',
                'nama.required' => 'Nama lengkap tidak boleh kosong!',
                'telp.required' => 'Nomor telepon tidak boleh kosong!',
                'telp.unique' => 'Nomor telepon sudah digunakan!',
                'alamat.required' => 'Alamat tidak boleh kosong!',
                'foto.image' => 'Foto yang dimasukan salah!',
            ]);
        } else {
            $validator = Validator::make($request->all(), [
                'nama' => 'required',
                'role' => 'required',
                'telp' => 'required|unique:users,telp,' . $user->id,
                'alamat' => 'required',
                'foto' => 'required|image|mimes:jpeg,jpg,png|max:2048',
            ], [
                'role.required' => 'Role harus dipilih!',
                'nama.required' => 'Nama lengkap tidak boleh kosong!',
                'telp.required' => 'Nomor telepon tidak boleh kosong!',
                'telp.unique' => 'Nomor telepon sudah digunakan!',
                'alamat.required' => 'Alamat tidak boleh kosong!',
                'foto.required' => 'Foto harus ditambahkan!',
                'foto.image' => 'Foto yang ditambahkan salah!',
            ]);
        }

        if ($validator->fails()) {
            $error = $validator->errors()->all();
            return back()->withInput()->with('status', $error);
        }

        if ($request->foto) {
            Storage::disk('local')->delete('public/uploads/' . $user->foto);
            $foto = str_replace(' ', '', $request->foto->getClientOriginalName());
            $namafoto = "user/" . date('YmdHis') . "." . $foto;
            $request->foto->storeAs('public/uploads', $namafoto);
        } else {
            $namafoto = $user->foto;
        }

        User::where('id', $user->id)
            ->update([
                'role' => $request->role,
                'nama' => $request->nama,
                'telp' => $request->telp,
                'alamat' => $request->alamat,
                'foto' => $namafoto,
            ]);

        return redirect('admin/user')->with('status', 'Berhasil mengubah User');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = User::find($id);
        Storage::disk('local')->delete('public/uploads/' . $user->foto);
        $user->delete();
        return back()->with('status', 'Berhasil menghapus User');
    }

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
