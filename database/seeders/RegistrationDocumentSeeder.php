<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RegistrationDocumentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Case 1: Pending Registration (ID 1) - Step 1 & 2 documents
        // Step 1 Documents
        DB::table('registration_document')->insert([
            'registrationId' => 1,
            'stepNumber' => 1,
            'fileName' => 'data_pribadi_user7.pdf',
            'fileUrl' => '/documents/registrations/1/data_pribadi_user7.pdf',
            'fileType' => 'pdf',
            'created_at' => now()->subDays(5),
        ]);

        // Step 2 Documents
        DB::table('registration_document')->insert([
            'registrationId' => 1,
            'stepNumber' => 2,
            'fileName' => 'ktp_user7.jpg',
            'fileUrl' => '/documents/registrations/1/ktp_user7.jpg',
            'fileType' => 'jpg',
            'created_at' => now()->subDays(4),
        ]);

        DB::table('registration_document')->insert([
            'registrationId' => 1,
            'stepNumber' => 2,
            'fileName' => 'npwp_user7.jpg',
            'fileUrl' => '/documents/registrations/1/npwp_user7.jpg',
            'fileType' => 'jpg',
            'created_at' => now()->subDays(4),
        ]);

        // Case 2: Passed Registration (ID 2) - All steps documents
        $documents = [
            [
                'stepNumber' => 1,
                'fileName' => 'data_pribadi_user2.pdf',
                'fileUrl' => '/documents/registrations/2/data_pribadi_user2.pdf',
                'fileType' => 'pdf',
                'daysAgo' => 15,
            ],
            [
                'stepNumber' => 2,
                'fileName' => 'ktp_user2.jpg',
                'fileUrl' => '/documents/registrations/2/ktp_user2.jpg',
                'fileType' => 'jpg',
                'daysAgo' => 13,
            ],
            [
                'stepNumber' => 2,
                'fileName' => 'npwp_user2.jpg',
                'fileUrl' => '/documents/registrations/2/npwp_user2.jpg',
                'fileType' => 'jpg',
                'daysAgo' => 13,
            ],
            [
                'stepNumber' => 3,
                'fileName' => 'sertifikat_internasional_user2.pdf',
                'fileUrl' => '/documents/registrations/2/sertifikat_internasional_user2.pdf',
                'fileType' => 'pdf',
                'daysAgo' => 11,
            ],
            [
                'stepNumber' => 4,
                'fileName' => 'referensi_user2.pdf',
                'fileUrl' => '/documents/registrations/2/referensi_user2.pdf',
                'fileType' => 'pdf',
                'daysAgo' => 9,
            ],
            [
                'stepNumber' => 5,
                'fileName' => 'surat_pernyataan_user2.pdf',
                'fileUrl' => '/documents/registrations/2/surat_pernyataan_user2.pdf',
                'fileType' => 'pdf',
                'daysAgo' => 7,
            ],
        ];

        foreach ($documents as $doc) {
            DB::table('registration_document')->insert([
                'registrationId' => 2,
                'stepNumber' => $doc['stepNumber'],
                'fileName' => $doc['fileName'],
                'fileUrl' => $doc['fileUrl'],
                'fileType' => $doc['fileType'],
                'created_at' => now()->subMonths(2)->addDays($doc['daysAgo']),
            ]);
        }

        // Case 3: Failed Registration (ID 3) - Documents for steps 1, 2, 3
        DB::table('registration_document')->insert([
            'registrationId' => 3,
            'stepNumber' => 1,
            'fileName' => 'data_pribadi_user3.pdf',
            'fileUrl' => '/documents/registrations/3/data_pribadi_user3.pdf',
            'fileType' => 'pdf',
            'created_at' => now()->subMonths(1)->subDays(5),
        ]);

        DB::table('registration_document')->insert([
            'registrationId' => 3,
            'stepNumber' => 2,
            'fileName' => 'ktp_user3.jpg',
            'fileUrl' => '/documents/registrations/3/ktp_user3.jpg',
            'fileType' => 'jpg',
            'created_at' => now()->subMonths(1)->subDays(3),
        ]);

        // Failed step 3 - submitted document (rejected)
        DB::table('registration_document')->insert([
            'registrationId' => 3,
            'stepNumber' => 3,
            'fileName' => 'sertifikat_lokal_user3.pdf',
            'fileUrl' => '/documents/registrations/3/sertifikat_lokal_user3.pdf',
            'fileType' => 'pdf',
            'created_at' => now()->subMonths(1),
        ]);
    }
}
