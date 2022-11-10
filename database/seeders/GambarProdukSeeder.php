<?php

namespace Database\Seeders;

use App\Models\GambarProduk;
use Illuminate\Database\Seeder;

class GambarProdukSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $gambarproduks = [
            [
                'produk_id' => '1',
                'gambar' => 'produk/berasmedium.jpg',
            ],
            [
                'produk_id' => '2',
                'gambar' => 'produk/berastermurah.jpg',
            ],
            [
                'produk_id' => '3',
                'gambar' => 'produk/cabemerahkeriting.jpg',
            ],
            [
                'produk_id' => '4',
                'gambar' => 'produk/jagung.jpg',
            ],
            [
                'produk_id' => '5',
                'gambar' => 'produk/bawangmerah.jpg',
            ],
            [
                'produk_id' => '6',
                'gambar' => 'produk/bawangputih.jpg',
            ],
            [
                'produk_id' => '7',
                'gambar' => 'produk/kedelai.jpg',
            ],
            [
                'produk_id' => '8',
                'gambar' => 'produk/ubijalar.jpg',
            ],
        ];

        GambarProduk::insert($gambarproduks);
    }
}
