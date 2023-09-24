<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Otp;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Session;

class UserController extends Controller
{
    public function index()
    {
        return view("auth.loginnew");
    }

    public function login(Request $request)
    {
        Session::flash('telp', $request->telp);
        $request->validate([
            'telp' => 'required',
            'password' => 'required'
        ], [
            'telp.required' => 'Telp tidak boleh kosong',
            'password.required' => 'Password tidak boleh kosong'
        ]);

        $infoLogin = [
            'telp' => $request->telp,
            'password' => $request->password
        ];

        $user = User::where('telp', $request->telp)->first();
        if (is_null($user)) {
            return redirect('login-new')->with('error', array('User tidak ditemukan'));
        }
        
        $user = User::where('telp', $request->telp)->first();
        if ($user->verifikasi == 0) {
            if ($user) {
                $this->otp($user->telp);
            }
            return redirect('kode')->with('error', array('Belum verifikasi'));
        }

        if (Auth::attempt($infoLogin)) {
            return redirect('home')->with('success', 'Berhasil login');
        } else {
            return back()->with('error', array('Telp dan password tidak sesuai'));
        }
    }


    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nama' => 'required',
            'telp' => 'required|unique:users',
            'alamat' => 'required',
            'role' => 'required',
            'password' => 'required|confirmed',
        ], [
            'nama.required' => 'Nama lengkap harus diisi!',
            'telp.required' => 'Nomor telepon harus diisi!',
            'telp.unique' => 'Nomor telepon sudah digunakan!',
            'alamat.required' => 'Alamat harus diisi!',
            'role.required' => 'Role harus dipilih!',
            'password.required' => 'Password harus diisi!',
            'password.confirmed' => 'Konfirmasi password tidak sesuai!'
        ]);

        $nol = substr($request->telp, 0, 1);

        if ($nol == '0') {
            return back()->with('error', array('Format telepon salah !'));
        }

        if ($validator->fails()) {
            $error = $validator->errors()->all();
            return back()->withInput()->with('error', $error);
        }

        $user = User::create(array_merge($request->all(), [
            'password' => bcrypt($request->password),
            'verifikasi' => '0',
        ]));

        if ($user) {
            $this->otp($user->telp);
        }

        return redirect('kode')->with('telp', $user->telp, 'masukan kode verifikasi');

        // return view('auth.otp')->with('success', 'Berhasil melakukan pendaftaran');
    }

    public function otp($telp)
    {
        $user = Otp::where('telp')->first();

        $curl = curl_init();
        $otp = rand(100000, 999999);

        if ($user) {
            Otp::where('telp', $telp)->update([
                'kode' => $otp
            ]);
        } else {
            Otp::create([
                'telp' => $telp,
                'kode' => $otp
            ]);
        }

        $data = [
            'target' => $telp,
            'message' => "Kode OTP Sitani : " . $otp
        ];

        curl_setopt(
            $curl,
            CURLOPT_HTTPHEADER,
            array(
                "Authorization: i0XBqAozh8uYyMpXe0#2",
            )
        );

        curl_setopt($curl, CURLOPT_CUSTOMREQUEST, "POST");
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_POSTFIELDS, http_build_query($data));
        curl_setopt($curl, CURLOPT_URL, "https://api.fonnte.com/send");
        curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, 0);
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, 0);

        $result = curl_exec($curl);

        curl_close($curl);
    }

    public function kode_otp2()
    {
        $otp = Otp::get();

        return view('auth.otp')->with('success', 'Berhasil melakukan pendaftaran');
    }

    function kode_verifikasi(Request $request)

    {
        $otp = Otp::where('telp', $request->telp)->first();

        if ($request->kode == $otp->kode) {
            User::where('telp', $request->telp)
                ->update([
                    'verifikasi' => '1'
                ]);
            return redirect('login-new')->with('success', 'Kode verifikasi cocok, silakan login');
        } else {
            return back()->with('error', array('kode verifikasi salah'));
        }
    }
}