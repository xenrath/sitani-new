<?php

namespace Database\Seeders;

use App\Models\Pangan;
use Carbon\Carbon;
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
            'file' => 'file/hargapangan.xlsx',
            'created_at' => Carbon::now()
        ];

        Pangan::insert($pangans);
    }
}
