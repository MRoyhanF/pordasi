<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $emailIndex = [];

        // Helper function untuk generate unique email
        $getUniqueEmail = function ($role) use (&$emailIndex) {
            if (!isset($emailIndex[$role])) {
                $emailIndex[$role] = 0;
                return "{$role}@gmail.com";
            }

            $emailIndex[$role]++;
            return "{$role}{$emailIndex[$role]}@gmail.com";
        };

        // SUPER ADMIN
        $superAdmins = [
            ['name' => 'Siti Nurlela', 'jenisKelamin' => 'Wanita'],
            ['name' => 'Ridwan', 'jenisKelamin' => 'Pria'],
        ];

        foreach ($superAdmins as $admin) {
            User::firstOrCreate(
                ['email' => $getUniqueEmail('superadmin')],
                [
                    'name' => $admin['name'],
                    'password' => Hash::make('password'),
                    'jenisKelamin' => $admin['jenisKelamin'],
                    'role' => 'SuperAdmin',
                    'phone' => null,
                    'alamat' => null,
                ]
            );
        }

        // ADMIN
        $admins = [
            ['name' => 'Baso Aditiya', 'jenisKelamin' => 'Pria'],
            ['name' => 'M. Fadhila Taqwa', 'jenisKelamin' => 'Wanita'],
            ['name' => 'Alfino Tryanugrah Rachim', 'jenisKelamin' => 'Pria'],
            ['name' => 'Rendi Sudrajat', 'jenisKelamin' => 'Pria'],
            ['name' => 'Fauzan Akbar', 'jenisKelamin' => 'Pria'],
        ];

        foreach ($admins as $admin) {
            User::firstOrCreate(
                ['email' => $getUniqueEmail('admin')],
                [
                    'name' => $admin['name'],
                    'password' => Hash::make('password'),
                    'jenisKelamin' => $admin['jenisKelamin'],
                    'role' => 'Admin',
                    'phone' => null,
                    'alamat' => null,
                ]
            );
        }

        // PELATIH
        $pelatih = [
            ['name' => 'Muhammad Nurdiansyah', 'jenisKelamin' => 'Pria'],
            ['name' => 'Ridwan', 'jenisKelamin' => 'Pria'],
            ['name' => 'Ratu Kholiah', 'jenisKelamin' => 'Wanita'],
            ['name' => 'Safitriani', 'jenisKelamin' => 'Wanita'],
            ['name' => 'Siti Nurlela', 'jenisKelamin' => 'Wanita'],
            ['name' => 'Lela Armila', 'jenisKelamin' => 'Wanita'],
            ['name' => 'Muhaimin', 'jenisKelamin' => 'Pria'],
            ['name' => 'Sukma Dewi', 'jenisKelamin' => 'Wanita'],
            ['name' => 'Nurdin', 'jenisKelamin' => 'Pria'],
            ['name' => 'Tarmizi', 'jenisKelamin' => 'Pria'],
        ];

        foreach ($pelatih as $p) {
            User::firstOrCreate(
                ['email' => $getUniqueEmail('pelatih')],
                [
                    'name' => $p['name'],
                    'password' => Hash::make('password'),
                    'jenisKelamin' => $p['jenisKelamin'],
                    'role' => 'Pelatih',
                    'phone' => null,
                    'alamat' => null,
                ]
            );
        }

        // VIEWER
        $viewers = [
            ['name' => 'Rustam, S.H., M.H., NL.P.', 'jenisKelamin' => 'Pria'],
            ['name' => 'H. Hasan Basri Husin, S.H., M.A.P.', 'jenisKelamin' => 'Pria'],
            ['name' => 'Karyadi, S.E.', 'jenisKelamin' => 'Pria'],
            ['name' => 'Shelly Marchelina', 'jenisKelamin' => 'Wanita'],
            ['name' => 'Sulaiman', 'jenisKelamin' => 'Pria'],
            ['name' => 'Yusuf', 'jenisKelamin' => 'Pria'],
            ['name' => 'Dendi', 'jenisKelamin' => 'Pria'],
            ['name' => 'Nur Subiyantoro, SE.', 'jenisKelamin' => 'Pria'],
            ['name' => 'Muhammad Ichsan, S.Kom', 'jenisKelamin' => 'Pria'],
        ];

        foreach ($viewers as $viewer) {
            User::firstOrCreate(
                ['email' => $getUniqueEmail('viewer')],
                [
                    'name' => $viewer['name'],
                    'password' => Hash::make('password'),
                    'jenisKelamin' => $viewer['jenisKelamin'],
                    'role' => 'Viewer',
                    'phone' => null,
                    'alamat' => null,
                ]
            );
        }
    }
}
