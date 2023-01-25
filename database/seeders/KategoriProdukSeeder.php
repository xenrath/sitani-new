<?php

namespace Database\Seeders;

use App\Models\KategoriProduk;
use Illuminate\Database\Seeder;

class KategoriProdukSeeder extends Seeder
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
                'nama' => 'Biasa',
            ],
            [
                'nama' => 'Tebas',
            ],
        ];

        KategoriProduk::insert($data);
    }
}