<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KategoriPangan extends Model
{
    use HasFactory;

    protected $fillable = [
        'kategori',
        'nama'
    ];

    public function hargapangan()
    {
        return $this->hasMany(HargaPangan::class);
    }
}
