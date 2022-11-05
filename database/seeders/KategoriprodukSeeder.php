<?php

namespace Database\Seeders;

use App\Models\Kategoriproduk;
use Illuminate\Database\Seeder;

class KategoriprodukSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
       $data = [
            [
                'nama' => 'Produk Biasa',
            ],
            [
                'nama' => 'Produk Tebas',
            ],
        ];

        Kategoriproduk::insert($data);
    }
}