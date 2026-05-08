<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AdminKabupatenSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Relasi Admin -> Kabupaten
        $adminKabupatenRelations = [
            ['name' => 'Baso Aditiya', 'idKabupaten' => 1],                    // Kota Jambi
            ['name' => 'M. Fadhila Taqwa', 'idKabupaten' => 2],                // Tanjung Jabung Barat
            ['name' => 'Alfino Tryanugrah Rachim', 'idKabupaten' => 3],        // Tanjung Jabung Timur
            ['name' => 'Rendi Sudrajat', 'idKabupaten' => 4],                  // Batanghari
            ['name' => 'Fauzan Akbar', 'idKabupaten' => 5],                    // Muaro Jambi
        ];

        foreach ($adminKabupatenRelations as $relation) {
            $user = User::where('name', $relation['name'])->first();

            if ($user) {
                // Gunakan updateOrInsert untuk avoid duplicate
                DB::table('admin_kabupaten')->updateOrInsert(
                    ['idUser' => $user->id, 'idKabupaten' => $relation['idKabupaten']],
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
