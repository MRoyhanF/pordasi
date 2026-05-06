<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AtletSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $atlets = [
            // Stable 1
            ['nama' => 'Ari Wijaya', 'umur' => 12, 'level' => 'Mula', 'jenisKelamin' => 'Pria', 'idStable' => 1],
            ['nama' => 'Siti Nurhaliza', 'umur' => 14, 'level' => 'Mula', 'jenisKelamin' => 'Wanita', 'idStable' => 1],
            ['nama' => 'Budi Santoso', 'umur' => 15, 'level' => 'Madya', 'jenisKelamin' => 'Pria', 'idStable' => 1],
            ['nama' => 'Ratna Sari', 'umur' => 16, 'level' => 'Madya', 'jenisKelamin' => 'Wanita', 'idStable' => 1],
            ['nama' => 'Doni Hermawan', 'umur' => 18, 'level' => 'Wira', 'jenisKelamin' => 'Pria', 'idStable' => 1],

            // Stable 2
            ['nama' => 'Ahmad Hidayat', 'umur' => 13, 'level' => 'Mula', 'jenisKelamin' => 'Pria', 'idStable' => 2],
            ['nama' => 'Eka Putri', 'umur' => 14, 'level' => 'Mula', 'jenisKelamin' => 'Wanita', 'idStable' => 2],
            ['nama' => 'Rinto Harahap', 'umur' => 16, 'level' => 'Madya', 'jenisKelamin' => 'Pria', 'idStable' => 2],
            ['nama' => 'Bella Monica', 'umur' => 17, 'level' => 'Madya', 'jenisKelamin' => 'Wanita', 'idStable' => 2],

            // Stable 3
            ['nama' => 'Yuki Tanaka', 'umur' => 11, 'level' => 'Mula', 'jenisKelamin' => 'Pria', 'idStable' => 3],
            ['nama' => 'Maya Kusuma', 'umur' => 15, 'level' => 'Madya', 'jenisKelamin' => 'Wanita', 'idStable' => 3],
            ['nama' => 'Fajar Rahman', 'umur' => 19, 'level' => 'Wira', 'jenisKelamin' => 'Pria', 'idStable' => 3],

            // Stable 4
            ['nama' => 'Gilang Pratama', 'umur' => 12, 'level' => 'Mula', 'jenisKelamin' => 'Pria', 'idStable' => 4],
            ['nama' => 'Nisa Rahmawati', 'umur' => 16, 'level' => 'Madya', 'jenisKelamin' => 'Wanita', 'idStable' => 4],

            // Stable 5
            ['nama' => 'Rizky Pratama', 'umur' => 14, 'level' => 'Mula', 'jenisKelamin' => 'Pria', 'idStable' => 5],
            ['nama' => 'Diana Handoko', 'umur' => 13, 'level' => 'Mula', 'jenisKelamin' => 'Wanita', 'idStable' => 5],
        ];

        foreach ($atlets as $atlet) {
            DB::table('_atlet')->insert([
                'nama' => $atlet['nama'],
                'umur' => $atlet['umur'],
                'level' => $atlet['level'],
                'jenisKelamin' => $atlet['jenisKelamin'],
                'idStable' => $atlet['idStable'],
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
