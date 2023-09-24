<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Produk extends Model
{
    use HasFactory;
    protected $table = 'produks';
    protected $fillable = [
        'nama',
        'user_id',
        'harga',
        'kategori_id',
        'stok',
        'latitude',
        'longitude',
        'deskripsi'
    ];

    public function kategori()
    {
        return $this->belongsTo(KategoriProduk::class);
    }
    
    public function user()
    {
        return $this->belongsTo(User::class, "user_id", "id");
    }

    public function gambar()
    {
        return $this->hasMany(GambarProduk::class);
    }
}
