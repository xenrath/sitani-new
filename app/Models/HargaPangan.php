<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HargaPangan extends Model
{
    use HasFactory;

    protected $fillable = [
        'pangan_id',
        'kategori',
        'nama',
        'harga',
    ];

    public function kategoripangan()
    {
        return $this->belongsTo(KategoriPangan::class, 'kategori', 'id');
    }

    public function rupiah($harga)
    {
        $hasil = number_format($harga, 0, ',', '.');
        return $hasil;
    }
}
