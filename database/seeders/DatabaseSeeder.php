<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();
        $this->call(UserSeeder::class);
        $this->call(KategoriprodukSeeder::class);
        $this->call(KategorihargapanganSeeder::class);
        $this->call(HargapanganSeeder::class);
        $this->call(ProdukSeeder::class);
        $this->call(BeritaSeeder::class);
    }
}
