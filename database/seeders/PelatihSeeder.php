<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PelatihSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Relasi Pelatih -> Stable
        $pelatihStableRelations = [
            // Al Hidayah Horse Stable (stable_id = 1)
            ['name' => 'Muhammad Nurdiansyah', 'stableId' => 1],
            ['name' => 'Ridwan', 'stableId' => 1],
            ['name' => 'Ratu Kholiah', 'stableId' => 1],
            ['name' => 'Safitriani', 'stableId' => 1],
            ['name' => 'Siti Nurlela', 'stableId' => 1],
            ['name' => 'Lela Armila', 'stableId' => 1],

            // Joko Tingkir Stable (stable_id = 2)
            ['name' => 'Muhaimin', 'stableId' => 2],

            // Marmer Horse Stable (stable_id = 3)
            ['name' => 'Sukma Dewi', 'stableId' => 3],

            // The Frest Stable Jambi (stable_id = 4)
            ['name' => 'Nurdin', 'stableId' => 4],
            ['name' => 'Tarmizi', 'stableId' => 4],
        ];

        foreach ($pelatihStableRelations as $relation) {
            $user = User::where('name', $relation['name'])->first();

            if ($user) {
                // Gunakan updateOrInsert pada pivot table untuk avoid duplicate
                DB::table('pelatih')->updateOrInsert(
                    ['userId' => $user->id, 'stableId' => $relation['stableId']],
                    [
                        'isActive' => 1,
                        'created_at' => now(),
                        'updated_at' => now(),
                    ]
                );
            }
        }
    }
}
