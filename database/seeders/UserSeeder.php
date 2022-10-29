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
                'password' => bcrypt('admin'),
                'role' => 'admin'
            ],
            [
                'nama' => 'Petani',
                'telp' => 'petani',
                'password' => bcrypt('petani'),
                'role' => 'petani'
            ],
            [
                'nama' => 'Tengkulak',
                'telp' => 'tengkulak',
                'password' => bcrypt('tengkulak'),
                'role' => 'tengkulak'
            ],
        ];

        User::insert($users);
    }
}
