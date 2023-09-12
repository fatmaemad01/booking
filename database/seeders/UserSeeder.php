<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class UserSeeder extends Seeder
{
    
    public function run(): void
    {
        DB::table('users')->insert([
            'first_name' => 'Noura',
            'last_name' => 'Mostafa',
            'email' => 'nouramostafa2001@gmail.com',
            'role' => 'admin',
            'phone' => '0595718157',
            'password' => Hash::make('password'),
        ]);
    }
}
