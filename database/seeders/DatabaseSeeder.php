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
        $this->call(BeritaSeeder::class);
        $this->call(PanganSeeder::class);
        $this->call(KategoriPanganSeeder::class);
        $this->call(HargaPanganSeeder::class);
        $this->call(KategoriProdukSeeder::class);
        $this->call(ProdukSeeder::class);
        $this->call(GambarProdukSeeder::class);
    }
}
