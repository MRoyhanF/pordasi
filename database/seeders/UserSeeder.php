<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Super Admin
        DB::table('users')->insert([
            'email' => 'superadmin@jambi.com',
            'password' => Hash::make('password123'),
            'jenisKelamin' => 'Pria',
            'role' => 'SuperAdmin',
            'phone' => '081234567890',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        // Admin Kabupaten 1
        DB::table('users')->insert([
            'email' => 'admin_jambi@jambi.com',
            'password' => Hash::make('password123'),
            'jenisKelamin' => 'Pria',
            'role' => 'Admin',
            'phone' => '081234567891',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        // Admin Kabupaten 2
        DB::table('users')->insert([
            'email' => 'admin_muaro@jambi.com',
            'password' => Hash::make('password123'),
            'jenisKelamin' => 'Wanita',
            'role' => 'Admin',
            'phone' => '081234567892',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        // Pelatih 1
        DB::table('users')->insert([
            'email' => 'pelatih1@jambi.com',
            'password' => Hash::make('password123'),
            'jenisKelamin' => 'Pria',
            'role' => 'Pelatih',
            'phone' => '081234567893',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        // Pelatih 2
        DB::table('users')->insert([
            'email' => 'pelatih2@jambi.com',
            'password' => Hash::make('password123'),
            'jenisKelamin' => 'Pria',
            'role' => 'Pelatih',
            'phone' => '081234567894',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        // Pelatih 3
        DB::table('users')->insert([
            'email' => 'pelatih3@jambi.com',
            'password' => Hash::make('password123'),
            'jenisKelamin' => 'Wanita',
            'role' => 'Pelatih',
            'phone' => '081234567895',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        // User untuk testing registration (akan menjadi admin)
        DB::table('users')->insert([
            'email' => 'pending_admin@jambi.com',
            'password' => Hash::make('password123'),
            'jenisKelamin' => 'Pria',
            'role' => 'Pelatih',
            'phone' => '081234567896',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}
