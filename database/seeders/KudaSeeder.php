<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class KudaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $kudas = [
            // =========================
            // AL HIDAYAH HORSE STABLE
            // stable_id = 1
            // =========================

            [
                'nama' => 'BIMO',
                'pasport' => 'BIMO SADLE',
                'prestasi' => null,
                'pemilik' => 'HAK MILIK AHS',
                'stable' => 1,
            ],
            [
                'nama' => 'MAWAR',
                'pasport' => 'MAWAR G3',
                'prestasi' => null,
                'pemilik' => 'HAK MILIK AHS',
                'stable' => 1,
            ],
            [
                'nama' => 'KENZO',
                'pasport' => 'KENZO SADLE SUPER',
                'prestasi' => null,
                'pemilik' => 'HAK MILIK AHS',
                'stable' => 1,
            ],
            [
                'nama' => 'SHAKOF',
                'pasport' => 'SHAKOF G3',
                'prestasi' => null,
                'pemilik' => 'HAK MILIK AHS',
                'stable' => 1,
            ],
            [
                'nama' => 'KING',
                'pasport' => 'KING G3',
                'prestasi' => null,
                'pemilik' => 'HAK MILIK AHS',
                'stable' => 1,
            ],
            [
                'nama' => 'BINTANG',
                'pasport' => 'BINTANG SADLE',
                'prestasi' => null,
                'pemilik' => 'HAK MILIK AHS',
                'stable' => 1,
            ],
            [
                'nama' => 'GOLDY',
                'pasport' => 'GOLDY G3',
                'prestasi' => null,
                'pemilik' => 'HAK MILIK AHS',
                'stable' => 1,
            ],
            [
                'nama' => 'BONAMI',
                'pasport' => 'BONAMI G2',
                'prestasi' => null,
                'pemilik' => 'HAK MILIK AHS',
                'stable' => 1,
            ],
            [
                'nama' => 'HUZAIMAH',
                'pasport' => 'HUZAIMAH SADLE',
                'prestasi' => null,
                'pemilik' => 'HAK MILIK AHS',
                'stable' => 1,
            ],
            [
                'nama' => 'ZIRA',
                'pasport' => 'ZIRA G3',
                'prestasi' => null,
                'pemilik' => 'HAK MILIK AHS',
                'stable' => 1,
            ],

            // =========================
            // JOKO TINGKIR STABLE
            // stable_id = 2
            // =========================

            [
                'nama' => 'Rumanah',
                'pasport' => null,
                'prestasi' => null,
                'pemilik' => 'H. Zulkhoiri',
                'stable' => 2,
            ],
            [
                'nama' => "Muti'ah",
                'pasport' => null,
                'prestasi' => null,
                'pemilik' => 'H. Zulkhoiri',
                'stable' => 2,
            ],

            // =========================
            // MARMER HORSE STABLE
            // stable_id = 3
            // =========================

            [
                'nama' => 'Rousey',
                'pasport' => 'Blank Ocy G 3',
                'prestasi' => null,
                'pemilik' => 'Nur Subiyantoro, SE.',
                'stable' => 3,
            ],
            [
                'nama' => 'Thunder Boy',
                'pasport' => 'Thunder KPI',
                'prestasi' => null,
                'pemilik' => 'Nur Subiyantoro, SE.',
                'stable' => 3,
            ],

            // =========================
            // THE FREST STABLE JAMBI
            // stable_id = 4
            // =========================

            [
                'nama' => 'black',
                'pasport' => null,
                'prestasi' => null,
                'pemilik' => null,
                'stable' => 4,
            ],
            [
                'nama' => 'King rajab',
                'pasport' => null,
                'prestasi' => null,
                'pemilik' => null,
                'stable' => 4,
            ],
        ];

        foreach ($kudas as $kuda) {
            DB::table('kuda')->insert([
                'nama' => $kuda['nama'],
                'pasport' => $kuda['pasport'],
                'prestasi' => $kuda['prestasi'],
                'pemilik' => $kuda['pemilik'],
                'stable' => $kuda['stable'],
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
