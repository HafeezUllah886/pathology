<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use Database\Seeders\tests\Andrology;
use Database\Seeders\tests\Haematology;
use Database\Seeders\tests\Biochemistry;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

       $this->call(userSeeder::class);
       $this->call(accountsSeeder::class);
       $this->call(unitsSeeder::class);
       $this->call(Biochemistry::class);
       $this->call(Haematology::class);
       $this->call(Andrology::class);

    }
}
