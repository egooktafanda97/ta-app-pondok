<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Support\Str;

use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class UserSeader extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'nama' => 'Admin Aplikasi',
            'username' => 'admin',
            'password' => bcrypt('password'),
            'remember_token' => Str::random(60),
            'role' => 'SUPER-ADMIN',
        ]);
        User::create([
            'nama' => 'Pimpinan',
            'username' => 'pimpinan',
            'password' => bcrypt('password'),
            'remember_token' => Str::random(60),
            'role' => 'PIMPINAN',
        ]);
    }
}
