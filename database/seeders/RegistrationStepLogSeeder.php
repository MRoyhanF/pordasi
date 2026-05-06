<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RegistrationStepLogSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Case 1: Pending Registration (ID 1)
        // Step 1 - Passed
        DB::table('registration_step_log')->insert([
            'registrationId' => 1,
            'stepNumber' => 1,
            'stepName' => 'Data Pribadi',
            'status' => 'Passed',
            'reviewedBy' => 1,
            'notes' => 'Data pribadi lengkap dan valid',
            'created_at' => now()->subDays(5),
        ]);

        // Step 2 - Pending
        DB::table('registration_step_log')->insert([
            'registrationId' => 1,
            'stepNumber' => 2,
            'stepName' => 'Dokumen Identitas',
            'status' => 'Pending',
            'reviewedBy' => null,
            'notes' => null,
            'created_at' => now()->subDays(4),
        ]);

        // Case 2: Passed Registration (ID 2)
        // All steps passed
        for ($step = 1; $step <= 5; $step++) {
            $stepNames = [
                1 => 'Data Pribadi',
                2 => 'Dokumen Identitas',
                3 => 'Sertifikat Pelatih',
                4 => 'Referensi',
                5 => 'Verifikasi Final',
            ];

            DB::table('registration_step_log')->insert([
                'registrationId' => 2,
                'stepNumber' => $step,
                'stepName' => $stepNames[$step],
                'status' => 'Passed',
                'reviewedBy' => 1,
                'notes' => 'Dokumen valid dan lengkap',
                'created_at' => now()->subMonths(2)->addDays($step * 2),
            ]);
        }

        // Case 3: Failed Registration (ID 3)
        // Step 1 - Passed
        DB::table('registration_step_log')->insert([
            'registrationId' => 3,
            'stepNumber' => 1,
            'stepName' => 'Data Pribadi',
            'status' => 'Passed',
            'reviewedBy' => 1,
            'notes' => 'Data pribadi valid',
            'created_at' => now()->subMonths(1)->subDays(5),
        ]);

        // Step 2 - Passed
        DB::table('registration_step_log')->insert([
            'registrationId' => 3,
            'stepNumber' => 2,
            'stepName' => 'Dokumen Identitas',
            'status' => 'Passed',
            'reviewedBy' => 1,
            'notes' => 'Dokumen identitas valid',
            'created_at' => now()->subMonths(1)->subDays(3),
        ]);

        // Step 3 - Failed
        DB::table('registration_step_log')->insert([
            'registrationId' => 3,
            'stepNumber' => 3,
            'stepName' => 'Sertifikat Pelatih',
            'status' => 'Failed',
            'reviewedBy' => 1,
            'notes' => 'Sertifikat tidak sesuai standar internasional. Harap submit sertifikat terbaru.',
            'created_at' => now()->subMonths(1),
        ]);
    }
}
