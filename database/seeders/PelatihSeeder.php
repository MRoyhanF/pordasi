<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PelatihSeeder extends Seeder
{
    public function run(): void
    {
        $pelatihStableRelations = [
            // Al Hidayah Horse Stable (stable_id = 1)
            ['name' => 'Muhammad Nurdiansyah', 'stableId' => 1, 'level' => 'utama'],
            ['name' => 'Ridwan',               'stableId' => 1, 'level' => 'sigap'],
            ['name' => 'Ratu Kholiah',         'stableId' => 1, 'level' => 'jelajah'],
            ['name' => 'Safitriani',           'stableId' => 1, 'level' => 'pelopor'],
            ['name' => 'Siti Nurlela',         'stableId' => 1, 'level' => 'jelajah'],
            ['name' => 'Lela Armila',          'stableId' => 1, 'level' => 'pelopor'],

            // Joko Tingkir Stable (stable_id = 2)
            ['name' => 'Muhaimin', 'stableId' => 2, 'level' => 'utama'],

            // Marmer Horse Stable (stable_id = 3)
            ['name' => 'Sukma Dewi', 'stableId' => 3, 'level' => 'sigap'],

            // The Frest Stable Jambi (stable_id = 4)
            ['name' => 'Nurdin',  'stableId' => 4, 'level' => 'lainnya'],
            ['name' => 'Tarmizi', 'stableId' => 4, 'level' => 'jelajah'],
        ];

        foreach ($pelatihStableRelations as $relation) {
            $user = User::where('name', $relation['name'])->first();

            if ($user) {
                DB::table('pelatih')->updateOrInsert(
                    ['userId' => $user->id, 'stableId' => $relation['stableId']],
                    [
                        'isActive'   => 1,
                        'level'      => $relation['level'],
                        'created_at' => now(),
                        'updated_at' => now(),
                    ]
                );
            }
        }
    }
}
