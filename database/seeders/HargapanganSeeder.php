<?php

namespace Database\Seeders;

use App\Models\HargaPangan;
use Illuminate\Database\Seeder;

class HargapanganSeeder extends Seeder
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
                'kategori_id' => '1',
                'namapangan' => 'Beras Medium',
                'harga' => '9500',
                'tanggal' => '27/10/22',
            ],
            [
                'kategori_id' => '1',
                'namapangan' => 'Beras Termurah',
                'harga' => '9000',
                'tanggal' => '27/10/22',
            ],
            [
                'kategori_id' => '2',
                'namapangan' => 'Cabe Merah Keriting',
                'harga' => '30000',
                'tanggal' => '27/10/22',
            ],
            [
                'kategori_id' => '2',
                'namapangan' => 'Cabe Merah Besar',
                'harga' => '30000',
                'tanggal' => '27/10/22',
            ],
            [
                'kategori_id' => '3',
                'namapangan' => 'Jagung',
                'harga' => '7000',
                'tanggal' => '27/10/22',
            ],
            [
                'kategori_id' => '4',
                'namapangan' => 'Bawang Merah',
                'harga' => '26000',
                'tanggal' => '27/10/22',
            ],
            [
                'kategori_id' => '4',
                'namapangan' => 'Bawang Bonggol',
                'harga' => '20000',
                'tanggal' => '27/10/22',
            ],
            [
                'kategori_id' => '4',
                'namapangan' => 'Bawang Putih Kating',
                'harga' => '23000',
                'tanggal' => '27/10/22',
            ],
            [
                'kategori_id' => '5',
                'namapangan' => 'Kedelai',
                'harga' => '13500',
                'tanggal' => '27/10/22',
            ],
            [
                'kategori_id' => '6',
                'namapangan' => 'Ubi Jalar',
                'harga' => '5000',
                'tanggal' => '27/10/22',
            ],
        ];

        HargaPangan::insert($data);
    }
}