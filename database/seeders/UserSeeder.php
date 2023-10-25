<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            "name" => "admin",
            "email" => "admin@gmail.com",
            "type" => "admin",
            "role" => "premium",
            "password" => Hash::make("12345678"),
        ]);

        User::create([
            "name" => "user1",
            "email" => "user1@gmail.com",
            "type" => "user",
            "role" => "premium",
            "password" => Hash::make("12345678"),
        ]);

        User::create([
            "name" => "user2",
            "email" => "user2@gmail.com",
            "type" => "user",
            "role" => "free",
            "password" => Hash::make("12345678"),
        ]);
    }
}
