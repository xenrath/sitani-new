<?php

namespace Database\Seeders;

use App\Models\Produk;
use Illuminate\Database\Seeder;

class ProdukSeeder extends Seeder
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
                'nama' => 'Beras Medium',
                'user_id' => '2',
                'harga' => '9500',
                'gambar' => 'produk/berasmedium.jpg',
                'kategori_id' => '1',
                'stok' => '1',
                'deskripsi' => 'Menyediakan produk beras medium dengan harga murah produk bagus',
            ],
            [
                'nama' => 'Beras Termurah',
                'user_id' => '2',
                'harga' => '9000',
                'gambar' => 'produk/berastermurah.jpg',
                'kategori_id' => '1',
                'stok' => '1',
                'deskripsi' => 'Menyediakan produk beras murah dengan produk berkulitas',
            ],
            [
                'nama' => 'Cabe merah keriting',
                'user_id' => '2',
                'harga' => '30000',
                'gambar' => 'produk/cabemerahkeriting.jpg',
                'kategori_id' => '1',
                'stok' => '1',
                'deskripsi' => 'Cabe merah keriting bagus produk terjamin murah dan berkualitas',
            ],
            [
                'nama' => 'Jagung',
                'user_id' => '2',
                'harga' => '7000',
                'gambar' => 'produk/jagung.jpg',
                'kategori_id' => '1',
                'stok' => '1',
                'deskripsi' => 'Jagung bagus harga terjangkau murah kualitas bisa dijamin',
            ],
            [
                'nama' => 'Bawang merah',
                'user_id' => '2',
                'harga' => '26000',
                'gambar' => 'produk/bawangmerah.jpg',
                'kategori_id' => '1',
                'stok' => '1',
                'deskripsi' => 'Menyediakan bawang merah baru panen produk bagus kualitas terbaik',
            ],
            [
                'nama' => 'Bawang putih',
                'user_id' => '2',
                'harga' => '23000',
                'gambar' => 'produk/bawangputih.jpg',
                'kategori_id' => '1',
                'stok' => '1',
                'deskripsi' => 'Menyediakan bawang putih produk bagus kualitas terbaik bisa di cek terlebih dahulu dan masih banyak bahan pangan yang lainnya',
            ],
            [
                'nama' => 'Kedelai',
                'user_id' => '2',
                'harga' => '13500',
                'gambar' => 'produk/kedelai.jpg',
                'kategori_id' => '1',
                'stok' => '1',
                'deskripsi' => 'Kedelai bagus produk berkualitas harga murah ',
            ],
            [
                'nama' => 'Ubi jalar',
                'user_id' => '2',
                'harga' => '13500',
                'gambar' => 'produk/ubijalar.jpg',
                'kategori_id' => '1',
                'stok' => '1',
                'deskripsi' => 'Menjual ubi jalar produk berkualitas bisa dicek terlebih dahulu harga murah terjamin bagus',
            ],
        ];

        Produk::insert($data);
    }
}
