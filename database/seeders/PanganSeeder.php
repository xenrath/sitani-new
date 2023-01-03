<?php

namespace Database\Seeders;

use App\Models\Pangan;
use Illuminate\Database\Seeder;

class PanganSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $pangans = [
            'file' => 'test.csv'
        ];

        Pangan::insert($pangans);
    }
}
