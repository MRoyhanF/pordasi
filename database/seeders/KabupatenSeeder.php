<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class KabupatenSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $kabupaten = [
            ['name' => 'Kota Jambi'],
            ['name' => 'Kabupaten Muaro Jambi'],
            ['name' => 'Kabupaten Batang Hari'],
            ['name' => 'Kabupaten Tanjung Jabung Barat'],
            ['name' => 'Kabupaten Tanjung Jabung Timur'],
            ['name' => 'Kabupaten Tebo'],
            ['name' => 'Kabupaten Sarolangun'],
            ['name' => 'Kabupaten Kerinci'],
            ['name' => 'Kabupaten Merangin'],
        ];

        foreach ($kabupaten as $item) {
            DB::table('kabupaten')->insert([
                'name' => $item['name'],
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
