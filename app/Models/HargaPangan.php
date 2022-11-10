<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HargaPangan extends Model
{
    use HasFactory;
    protected $table = 'harga_pangans';
    protected $fillable = [
        'kategori_id', 'namapangan', 'harga', 'tanggal'
    ];

    public function kategoriharga()
    {
        return $this->belongsTo(KategoriHarga::class, "kategori_id", "id");
    }

    public function rupiah($harga)
    {
        $hasil = number_format($harga, 0, ',', '.');
        return $hasil;
    }
}
