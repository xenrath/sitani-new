<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $users = [
            [
                'nama' => 'Admin',
                'telp' => 'admin',
                'alamat' => 'Tegal',
                'password' => bcrypt('admin'),
                'gambar' => 'user/admin.jpeg',
                'role' => 'admin'
            ],
            [
                'nama' => 'Petani',
                'telp' => 'petani',
                'alamat' => 'Tegal',
                'password' => bcrypt('petani'),
                'gambar' => 'user/petani.jpeg',
                'role' => 'petani'
            ],
            [
                'nama' => 'Petani2',
                'telp' => '08978556760',
                'alamat' => 'Tegal',
                'password' => bcrypt('petani2'),
                'gambar' => 'user/petani2.jpeg',
                'role' => 'petani'
            ],
            [
                'nama' => 'Petani3',
                'telp' => '08978556767',
                'alamat' => 'Tegal',
                'password' => bcrypt('petani3'),
                'gambar' => 'user/petani.jpeg',
                'role' => 'petani'
            ],
            [
                'nama' => 'Tengkulak',
                'telp' => 'tengkulak',
                'alamat' => 'Tegal',
                'password' => bcrypt('tengkulak'),
                'gambar' => 'user/tengkulak.jpeg',
                'role' => 'tengkulak'
            ],
        ];

        User::insert($users);
    }
}
