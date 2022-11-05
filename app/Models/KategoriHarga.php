<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KategoriHarga extends Model
{
    use HasFactory;
    protected $table = 'kategori_hargas';
    protected $fillable = ['kategori', 'nama'];

    public function hargapangan()
    {
        return $this->hasMany(HargaPangan::class);
    }
}
