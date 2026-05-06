<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AdminRegistrationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Case 1: Pending Registration (user 7 - pending_admin)
        DB::table('admin_registration')->insert([
            'userId' => 7,
            'currentStep' => 2,
            'totalSteps' => 5,
            'status' => 'Pending',
            'notes' => 'Menunggu verifikasi dokumen lengkap',
            'reviewedBy' => null,
            'created_at' => now()->subDays(5),
            'updated_at' => now()->subDays(2),
        ]);

        // Case 2: Passed Registration (user 2 - admin_jambi)
        DB::table('admin_registration')->insert([
            'userId' => 2,
            'currentStep' => 5,
            'totalSteps' => 5,
            'status' => 'Passed',
            'notes' => 'Semua dokumen lengkap dan terverifikasi',
            'reviewedBy' => 1,
            'created_at' => now()->subMonths(2),
            'updated_at' => now()->subMonths(1),
        ]);

        // Case 3: Failed Registration (contoh user yang ditolak)
        DB::table('admin_registration')->insert([
            'userId' => 3,
            'currentStep' => 3,
            'totalSteps' => 5,
            'status' => 'Failed',
            'notes' => 'Dokumen identitas tidak sesuai standar. Silakan submit ulang dengan dokumen yang valid.',
            'reviewedBy' => 1,
            'created_at' => now()->subMonths(1),
            'updated_at' => now()->subDays(10),
        ]);
    }
}
