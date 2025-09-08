<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class userSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'name' => "Admin",
            'email' => "admin@email.com",
            'password' => Hash::make("admin"),
            'role' => "Admin",
        ]);
        User::create([
            'name' => "Operator",
            'email' => "operator@email.com",
            'password' => Hash::make("operator"),
            'role' => "Operator",
        ]);
        User::create([
            'name' => "Cashier",
            'email' => "cashier@email.com",
            'password' => Hash::make("cashier"),
            'role' => "Cashier",
        ]);
    }
}
