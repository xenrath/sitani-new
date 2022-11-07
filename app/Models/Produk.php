<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Produk extends Model
{
    use HasFactory;
    protected $table = 'produks';
    protected $fillable = ['nama', 'user_id', 'harga', 'gambar', 'kategori_id', 'stok', 'deskripsi'];

    public function kategoriproduk()
    {
        return $this->belongsTo(Kategoriproduk::class, "produk_id", "id");
    }
    public function user()
    {
        return $this->belongsTo(User::class, "user_id", "id");
    }
}
