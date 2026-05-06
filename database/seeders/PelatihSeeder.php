<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PelatihSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Pelatih 1 -> Stable 1
        DB::table('_pelatih')->insert([
            'userId' => 4,
            'stableId' => 1,
            'isActive' => true,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        // Pelatih 2 -> Stable 2
        DB::table('_pelatih')->insert([
            'userId' => 5,
            'stableId' => 2,
            'isActive' => true,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        // Pelatih 2 -> Stable 3 (satu trainer bisa multiple stable)
        DB::table('_pelatih')->insert([
            'userId' => 5,
            'stableId' => 3,
            'isActive' => true,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        // Pelatih 3 -> Stable 4
        DB::table('_pelatih')->insert([
            'userId' => 6,
            'stableId' => 4,
            'isActive' => true,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        // Pelatih 3 -> Stable 5
        DB::table('_pelatih')->insert([
            'userId' => 6,
            'stableId' => 5,
            'isActive' => true,
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}
