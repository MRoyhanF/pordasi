<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class KudaSeeder extends Seeder
{
    public function run(): void
    {
        $kudas = [
            // AL HIDAYAH HORSE STABLE - stable_id = 1
            ['nama' => 'BIMO',      'pasport' => 'BIMO SADLE',          'prestasi' => null, 'pemilik' => 'HAK MILIK AHS', 'stable' => 1, 'keahlian' => 'berkuda_memanah'],
            ['nama' => 'MAWAR',     'pasport' => 'MAWAR G3',            'prestasi' => null, 'pemilik' => 'HAK MILIK AHS', 'stable' => 1, 'keahlian' => 'berkuda_memanah'],
            ['nama' => 'KENZO',     'pasport' => 'KENZO SADLE SUPER',   'prestasi' => null, 'pemilik' => 'HAK MILIK AHS', 'stable' => 1, 'keahlian' => 'jumping'],
            ['nama' => 'SHAKOF',    'pasport' => 'SHAKOF G3',           'prestasi' => null, 'pemilik' => 'HAK MILIK AHS', 'stable' => 1, 'keahlian' => 'dressage'],
            ['nama' => 'KING',      'pasport' => 'KING G3',             'prestasi' => null, 'pemilik' => 'HAK MILIK AHS', 'stable' => 1, 'keahlian' => 'berkuda_memanah'],
            ['nama' => 'BINTANG',   'pasport' => 'BINTANG SADLE',       'prestasi' => null, 'pemilik' => 'HAK MILIK AHS', 'stable' => 1, 'keahlian' => 'polo'],
            ['nama' => 'GOLDY',     'pasport' => 'GOLDY G3',            'prestasi' => null, 'pemilik' => 'HAK MILIK AHS', 'stable' => 1, 'keahlian' => 'jumping'],
            ['nama' => 'BONAMI',    'pasport' => 'BONAMI G2',           'prestasi' => null, 'pemilik' => 'HAK MILIK AHS', 'stable' => 1, 'keahlian' => 'dressage'],
            ['nama' => 'HUZAIMAH', 'pasport' => 'HUZAIMAH SADLE',      'prestasi' => null, 'pemilik' => 'HAK MILIK AHS', 'stable' => 1, 'keahlian' => 'berkuda_memanah'],
            ['nama' => 'ZIRA',      'pasport' => 'ZIRA G3',             'prestasi' => null, 'pemilik' => 'HAK MILIK AHS', 'stable' => 1, 'keahlian' => 'polo'],

            // JOKO TINGKIR STABLE - stable_id = 2
            ['nama' => 'Rumanah',  'pasport' => null, 'prestasi' => null, 'pemilik' => 'H. Zulkhoiri', 'stable' => 2, 'keahlian' => 'berkuda_memanah'],
            ['nama' => "Muti'ah",  'pasport' => null, 'prestasi' => null, 'pemilik' => 'H. Zulkhoiri', 'stable' => 2, 'keahlian' => 'jumping'],

            // MARMER HORSE STABLE - stable_id = 3
            ['nama' => 'Rousey',      'pasport' => 'Blank Ocy G 3', 'prestasi' => null, 'pemilik' => 'Nur Subiyantoro, SE.', 'stable' => 3, 'keahlian' => 'dressage'],
            ['nama' => 'Thunder Boy', 'pasport' => 'Thunder KPI',   'prestasi' => null, 'pemilik' => 'Nur Subiyantoro, SE.', 'stable' => 3, 'keahlian' => 'jumping'],

            // THE FREST STABLE JAMBI - stable_id = 4
            ['nama' => 'black',      'pasport' => null, 'prestasi' => null, 'pemilik' => null, 'stable' => 4, 'keahlian' => 'polo'],
            ['nama' => 'King rajab', 'pasport' => null, 'prestasi' => null, 'pemilik' => null, 'stable' => 4, 'keahlian' => 'berkuda_memanah'],
        ];

        foreach ($kudas as $kuda) {
            DB::table('kuda')->insert([
                'nama'       => $kuda['nama'],
                'pasport'    => $kuda['pasport'],
                'prestasi'   => $kuda['prestasi'],
                'pemilik'    => $kuda['pemilik'],
                'stable'     => $kuda['stable'],
                'keahlian'   => $kuda['keahlian'],
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
