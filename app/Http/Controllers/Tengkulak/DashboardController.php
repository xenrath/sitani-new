<?php

namespace App\Http\Controllers\Tengkulak;

use App\Http\Controllers\Controller;
use App\Models\Pangan;

class DashboardController extends Controller
{
    public function index()
    {
        $pangans = Pangan::orderByDesc('created_at')->paginate(1);

        return view('home', compact('pangans'));
    }
}
