<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GambarProduk extends Model
{
    use HasFactory;

    protected $table = 'gambar_produks';

    protected $fillable = [
        'produk_id', 
        'gambar',
    ];

    public function produks()
    {
        return $this->belongsTo(Produk::class);
    }
}
