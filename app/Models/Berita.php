<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Berita extends Model
{
    use HasFactory;

    protected $fillable = [
        'kategoripangan_id',
        'judul',
        'isi',
        'gambar',
    ];

    public function kategoripangan()
    {
        return $this->belongsTo(KategoriPangan::class);
    }
}
