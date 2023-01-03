<?php

namespace Database\Seeders;

use App\Models\KategoriPangan;
use Illuminate\Database\Seeder;

class KategoriPanganSeeder extends Seeder
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
                'kategori' => 'CBI',
                'nama' => 'Cabai',
            ],
            [
                'kategori' => 'JGG',
                'nama' => 'Jagung',
            ],
            [
                'kategori' => 'BWG',
                'nama' => 'Bawang',
            ],
            [
                'kategori' => 'KDL',
                'nama' => 'Kedelai',
            ],
            [
                'kategori' => 'UJL',
                'nama' => 'Ubi Jalar',
            ],
        ];

        KategoriPangan::insert($data);
    }
}
