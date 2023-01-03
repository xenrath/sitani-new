<?php

namespace Database\Seeders;

use App\Models\HargaPangan;
use Illuminate\Database\Seeder;

class HargaPanganSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $hargapangans = [
            [
                'pangan_id' => '1',
                'kategori' => '1',
                'nama' => 'Beras Medium',
                'harga' => '9500',
            ],
            [
                'pangan_id' => '1',
                'kategori' => '1',
                'nama' => 'Beras Termurah',
                'harga' => '9000',
            ],
            [
                'pangan_id' => '1',
                'kategori' => '2',
                'nama' => 'Cabe Merah Keriting',
                'harga' => '30000',
            ],
            [
                'pangan_id' => '1',
                'kategori' => '2',
                'nama' => 'Cabe Merah Besar',
                'harga' => '30000',
            ],
            [
                'pangan_id' => '1',
                'kategori' => '3',
                'nama' => 'Jagung',
                'harga' => '7000',
            ],
            [
                'pangan_id' => '1',
                'kategori' => '4',
                'nama' => 'Bawang Merah',
                'harga' => '26000',
            ],
            [
                'pangan_id' => '1',
                'kategori' => '4',
                'nama' => 'Bawang Bonggol',
                'harga' => '20000',
            ],
            [
                'pangan_id' => '1',
                'kategori' => '4',
                'nama' => 'Bawang Putih Kating',
                'harga' => '23000',
            ],
            [
                'pangan_id' => '1',
                'kategori' => '5',
                'nama' => 'Kedelai',
                'harga' => '13500',
            ],
            [
                'pangan_id' => '1',
                'kategori' => '6',
                'nama' => 'Ubi Jalar',
                'harga' => '5000',
            ],
        ];

        HargaPangan::insert($hargapangans);
    }
}
