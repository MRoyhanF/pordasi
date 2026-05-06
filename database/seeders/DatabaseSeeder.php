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
            UserSeeder::class,
            AdminKabupatenSeeder::class,
            StableSeeder::class,
            AtletSeeder::class,
            PelatihSeeder::class,
            AdminRegistrationSeeder::class,
            RegistrationStepLogSeeder::class,
            RegistrationDocumentSeeder::class,
        ]);
    }
}
