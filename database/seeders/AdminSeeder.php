<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    public function run(): void
    {
        User::create([
            'name' => 'Administrator KSPM',
            'username' => 'admin1',
            'email' => 'admin1@gmail.com',
            'password' => Hash::make('admin123'), // Ganti password sesuai keinginan
            'role' => 'admin',
        ]);
    }
}
