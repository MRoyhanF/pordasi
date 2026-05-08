<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Seed data in order of dependencies
        $this->call([
            KabupatenSeeder::class,
            StableSeeder::class,
            UserSeeder::class,
            AdminKabupatenSeeder::class,
            PelatihSeeder::class,
            KudaSeeder::class,
            AtletSeeder::class,
        ]);
    }
}
