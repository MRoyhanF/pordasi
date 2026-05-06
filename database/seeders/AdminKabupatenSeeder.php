<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AdminKabupatenSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Admin 1 -> Kota Jambi
        DB::table('_admin_kabupaten')->insert([
            'idUser' => 2,
            'idKabupaten' => 1,
            'isActive' => true,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        // Admin 2 -> Kabupaten Muaro Jambi
        DB::table('_admin_kabupaten')->insert([
            'idUser' => 3,
            'idKabupaten' => 2,
            'isActive' => true,
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}
