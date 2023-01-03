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
                'alamat' => null,
                'password' => bcrypt('admin'),
                'foto' => null,
                'role' => 'admin'
            ],
            [
                'nama' => 'Petani',
                'telp' => 'petani',
                'alamat' => 'Tegal',
                'password' => bcrypt('petani'),
                'foto' => 'user/petani1.jpg',
                'role' => 'petani'
            ],
            [
                'nama' => 'Petani2',
                'telp' => '08978556760',
                'alamat' => 'Tegal',
                'password' => bcrypt('petani2'),
                'foto' => 'user/petani2.jpg',
                'role' => 'petani'
            ],
            [
                'nama' => 'Tengkulak',
                'telp' => 'tengkulak',
                'alamat' => 'Tegal',
                'password' => bcrypt('tengkulak'),
                'foto' => 'user/tengkulak1.jpeg',
                'role' => 'tengkulak'
            ],
            [
                'nama' => 'Tengkulak2',
                'telp' => 'tengkulak2',
                'alamat' => 'Tegal',
                'password' => bcrypt('tengkulak2'),
                'foto' => 'user/tengkulak2.jpg',
                'role' => 'tengkulak'
            ],
        ];

        User::insert($users);
    }
}
