<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class StableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $stables = [
            [
                'name' => 'Stable Merdeka Jambi',
                'idKabupaten' => 1,
                'alamat' => 'Jl. Jenderal Sudirman No. 123, Jambi',
                'longitude' => '104.7488',
                'latitude' => '-1.6308',
            ],
            [
                'name' => 'Stable Harapan Muaro',
                'idKabupaten' => 2,
                'alamat' => 'Jl. Sungai Batang Hari Km 5, Muaro Jambi',
                'longitude' => '104.6789',
                'latitude' => '-1.5234',
            ],
            [
                'name' => 'Stable Jaya Batang Hari',
                'idKabupaten' => 3,
                'alamat' => 'Jl. Pattimura No. 45, Muara Bulian',
                'longitude' => '104.3456',
                'latitude' => '-1.7890',
            ],
            [
                'name' => 'Stable Cemerlang TJB Barat',
                'idKabupaten' => 4,
                'alamat' => 'Jl. Raya Kuala Tungkal Km 3, Tanjung Jabung Barat',
                'longitude' => '103.4567',
                'latitude' => '-0.8234',
            ],
            [
                'name' => 'Stable Sejahtera TJB Timur',
                'idKabupaten' => 5,
                'alamat' => 'Jl. Ahmad Yani No. 78, Kota Terusan',
                'longitude' => '103.8901',
                'latitude' => '-0.3456',
            ],
            [
                'name' => 'Stable Prestasi Tebo',
                'idKabupaten' => 6,
                'alamat' => 'Jl. Imam Bonjol No. 56, Terusan',
                'longitude' => '102.5678',
                'latitude' => '0.8901',
            ],
        ];

        foreach ($stables as $stable) {
            DB::table('_stable')->insert([
                'name' => $stable['name'],
                'idKabupaten' => $stable['idKabupaten'],
                'alamat' => $stable['alamat'],
                'longitude' => $stable['longitude'],
                'latitude' => $stable['latitude'],
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
