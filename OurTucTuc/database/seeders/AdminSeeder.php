<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class AdminSeeder extends Seeder
{
    public function run(): void
    {
        User::updateOrCreate(
            ['email' => 'admin1ourtuctuc@gmail.com'],
            [
                'name' => 'Admin OurTucTuc',
                'NoTelp' => '081234567890',
                'password' => Hash::make('admin1234567890'),
                'role' => 'admin',
            ]
        );
    }
}
