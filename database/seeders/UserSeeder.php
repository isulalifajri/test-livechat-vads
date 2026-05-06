<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'name' => 'agenbot1',
            'email' => 'agenbot1@gmail.com',
            'password' => Hash::make('123456'),
        ]);

        User::create([
            'name' => 'agenbot2',
            'email' => 'agenbot2@gmail.com',
            'password' => Hash::make('123456'),
        ]);

        User::create([
            'name' => 'agenbot3',
            'email' => 'agenbot3@gmail.com',
            'password' => Hash::make('123456'),
        ]);
    }
}
