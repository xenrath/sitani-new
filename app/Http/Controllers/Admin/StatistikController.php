<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\HargaPangan;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class StatistikController extends Controller
{
    public function index()
    {
        $hargapangans = HargaPangan::with('pangan')->get()->groupBy('nama');

        // return $hargapangans;

        $statistik = array();

        foreach ($hargapangans as $key => $value) {
            $data = array();
            $label = array();
            foreach ($value as $hargapangan) {
                array_push($data, $hargapangan->harga);
                array_push($label, date('d M Y', strtotime($hargapangan->pangan->created_at)));
            }
            $statistik[] = array(
                'id' => Str::slug($key),
                'pangan' => $key,
                'data' => $data,
                'label' => $label
            );
        }

        // return $statistik;

        return view('admin.statistik.index', compact('statistik'));
    }
}
