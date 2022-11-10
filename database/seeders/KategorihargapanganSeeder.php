<?php

namespace Database\Seeders;

use App\Models\KategoriHarga;
use Illuminate\Database\Seeder;

class KategorihargapanganSeeder extends Seeder
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
                'kategori' => 'BRS',
                'nama' => 'Beras',
            ],
            [
                'kategori' => 'CB',
                'nama' => 'Cabe',
            ],
            [
                'kategori' => 'JG',
                'nama' => 'Jagung',
            ],
            [
                'kategori' => 'BW',
                'nama' => 'Bawang',
            ],
            [
                'kategori' => 'KD',
                'nama' => 'Kedelai',
            ],
            [
                'kategori' => 'UJ',
                'nama' => 'Ubi Jalar',
            ],
        ];

        KategoriHarga::insert($data);
    }
}
