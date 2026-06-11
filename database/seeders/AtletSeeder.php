<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AtletSeeder extends Seeder
{
    public function run(): void
    {
        $atlets = [
            // A. Al Hidayah Horse Stable (AHS) - idStable 1
            ['nama' => 'M.Rizky Penandra', 'level' => 'Mula', 'jenisKelamin' => 'Pria', 'alamat' => 'Kerinci', 'tanggal_lahir' => '2009-04-07', 'idStable' => 1, 'status' => 'aktif', 'prestasi' => 'Juara 1 Lomba Berkuda Memanah Tingkat Provinsi 2023'],
            ['nama' => 'Alvino Tryanugrah Rachim', 'level' => 'Mula', 'jenisKelamin' => 'Pria', 'alamat' => 'Kota Jambi', 'tanggal_lahir' => '2008-12-23', 'idStable' => 1, 'status' => 'aktif', 'prestasi' => null],
            ['nama' => 'M.Rendy Sudrajat', 'level' => 'Mula', 'jenisKelamin' => 'Pria', 'alamat' => 'Muaro Jambi', 'tanggal_lahir' => '2008-11-22', 'idStable' => 1, 'status' => 'aktif', 'prestasi' => 'Juara 2 Kejurda Berkuda 2024'],
            ['nama' => 'Muhammad Dzikwan Alfaraby', 'level' => 'Mula', 'jenisKelamin' => 'Pria', 'alamat' => 'Merangin', 'tanggal_lahir' => '2008-08-24', 'idStable' => 1, 'status' => 'aktif', 'prestasi' => null],
            ['nama' => 'Farrel Herdinansyah', 'level' => 'Mula', 'jenisKelamin' => 'Pria', 'alamat' => 'Batang Hari', 'tanggal_lahir' => '2008-04-26', 'idStable' => 1, 'status' => 'aktif', 'prestasi' => null],
            ['nama' => 'Baso Aditya Rayhan Febriyansyah', 'level' => 'Mula', 'jenisKelamin' => 'Pria', 'alamat' => 'Tanjab Tim', 'tanggal_lahir' => '2007-02-28', 'idStable' => 1, 'status' => 'tidak_aktif', 'prestasi' => null],
            ['nama' => 'Muhammad Fadhilah Taqwa', 'level' => 'Mula', 'jenisKelamin' => 'Pria', 'alamat' => 'Kota Jambi', 'tanggal_lahir' => '2008-06-23', 'idStable' => 1, 'status' => 'aktif', 'prestasi' => 'Juara 3 Lomba Berkuda Tingkat Kabupaten 2023'],
            ['nama' => 'Raffa Dega Saputra', 'level' => 'Mula', 'jenisKelamin' => 'Pria', 'alamat' => 'Muaro Jambi', 'tanggal_lahir' => '2006-12-03', 'idStable' => 1, 'status' => 'aktif', 'prestasi' => null],
            ['nama' => 'M.Raffa Shadiqy', 'level' => 'Mula', 'jenisKelamin' => 'Pria', 'alamat' => 'Kota Jambi', 'tanggal_lahir' => '2007-01-13', 'idStable' => 1, 'status' => 'aktif', 'prestasi' => null],
            ['nama' => 'M.Ilham Ramadhan', 'level' => 'Mula', 'jenisKelamin' => 'Pria', 'alamat' => 'Muaro Jambi', 'tanggal_lahir' => '2008-07-20', 'idStable' => 1, 'status' => 'tidak_aktif', 'prestasi' => null],
            ['nama' => 'Andra Pratama Hasyit', 'level' => 'Mula', 'jenisKelamin' => 'Pria', 'alamat' => 'Tanjab Tim', 'tanggal_lahir' => '2009-06-08', 'idStable' => 1, 'status' => 'aktif', 'prestasi' => null],
            ['nama' => 'Andre Pratama Hasyit', 'level' => 'Mula', 'jenisKelamin' => 'Pria', 'alamat' => 'Tanjab Tim', 'tanggal_lahir' => '2009-06-08', 'idStable' => 1, 'status' => 'aktif', 'prestasi' => null],
            ['nama' => 'Fatih Wasi Nihal', 'level' => 'Mula', 'jenisKelamin' => 'Pria', 'alamat' => 'Batang Hari', 'tanggal_lahir' => '2008-03-03', 'idStable' => 1, 'status' => 'aktif', 'prestasi' => null],
            ['nama' => 'M.Dimas Valentino', 'level' => 'Mula', 'jenisKelamin' => 'Pria', 'alamat' => 'Kota Jambi', 'tanggal_lahir' => '2009-12-11', 'idStable' => 1, 'status' => 'aktif', 'prestasi' => null],
            ['nama' => 'M.Arvin Ersyad', 'level' => 'Mula', 'jenisKelamin' => 'Pria', 'alamat' => 'Tanjab Tim', 'tanggal_lahir' => '2009-11-10', 'idStable' => 1, 'status' => 'tidak_aktif', 'prestasi' => null],
            ['nama' => 'Sayyid Husain Al-Aziz', 'level' => 'Mula', 'jenisKelamin' => 'Pria', 'alamat' => 'Merangin', 'tanggal_lahir' => '2008-09-08', 'idStable' => 1, 'status' => 'aktif', 'prestasi' => 'Juara 1 Kejurnas Berkuda Memanah 2024'],
            ['nama' => 'M.Nazhif Syukri', 'level' => 'Mula', 'jenisKelamin' => 'Pria', 'alamat' => 'Tanjab Bar', 'tanggal_lahir' => '2010-11-21', 'idStable' => 1, 'status' => 'aktif', 'prestasi' => null],
            ['nama' => 'M.Wildan Fachrurizky Mj', 'level' => 'Mula', 'jenisKelamin' => 'Pria', 'alamat' => 'Kota Jambi', 'tanggal_lahir' => '2010-11-10', 'idStable' => 1, 'status' => 'aktif', 'prestasi' => null],
            ['nama' => 'Adilla Dimitri', 'level' => 'Mula', 'jenisKelamin' => 'Wanita', 'alamat' => 'Sarolangun', 'tanggal_lahir' => '2009-09-22', 'idStable' => 1, 'status' => 'aktif', 'prestasi' => null],
            ['nama' => 'M.Naufal Al-Hadziq', 'level' => 'Mula', 'jenisKelamin' => 'Pria', 'alamat' => 'Batang Hari', 'tanggal_lahir' => '2010-04-04', 'idStable' => 1, 'status' => 'aktif', 'prestasi' => null],

            // B. JOKO TINGKIR STABLE - idStable 2
            ['nama' => 'Aldiano Rizky Kurniawan', 'level' => 'Mula', 'jenisKelamin' => 'Pria', 'alamat' => 'Batang Hari', 'tanggal_lahir' => '2010-06-01', 'idStable' => 2, 'status' => 'aktif', 'prestasi' => null],
            ['nama' => 'Nauval Akbar', 'level' => 'Mula', 'jenisKelamin' => 'Pria', 'alamat' => 'Muaro Jambi', 'tanggal_lahir' => '2009-11-23', 'idStable' => 2, 'status' => 'aktif', 'prestasi' => 'Juara 2 Lomba Berkuda Tingkat Provinsi 2023'],
            ['nama' => 'M.Toha Mahardika', 'level' => 'Mula', 'jenisKelamin' => 'Pria', 'alamat' => 'Tanjab Bar', 'tanggal_lahir' => '2010-02-15', 'idStable' => 2, 'status' => 'aktif', 'prestasi' => null],
            ['nama' => 'Ahmad Alif Muzacky', 'level' => 'Mula', 'jenisKelamin' => 'Pria', 'alamat' => 'Bungo', 'tanggal_lahir' => '2010-11-09', 'idStable' => 2, 'status' => 'tidak_aktif', 'prestasi' => null],
            ['nama' => 'Mus\'af Raihan Azzikri', 'level' => 'Mula', 'jenisKelamin' => 'Pria', 'alamat' => 'Tebo', 'tanggal_lahir' => '2011-12-28', 'idStable' => 2, 'status' => 'aktif', 'prestasi' => null],
            ['nama' => 'Ahmad Syauqi Anshari', 'level' => 'Mula', 'jenisKelamin' => 'Pria', 'alamat' => 'Muaro Jambi', 'tanggal_lahir' => '2012-02-22', 'idStable' => 2, 'status' => 'aktif', 'prestasi' => null],
            ['nama' => 'M.Randy Nata', 'level' => 'Mula', 'jenisKelamin' => 'Pria', 'alamat' => 'Muaro Jambi', 'tanggal_lahir' => '2012-08-22', 'idStable' => 2, 'status' => 'aktif', 'prestasi' => null],
            ['nama' => 'Sebji Ziyan Hariz', 'level' => 'Mula', 'jenisKelamin' => 'Pria', 'alamat' => 'Kota Jambi', 'tanggal_lahir' => '2012-09-30', 'idStable' => 2, 'status' => 'aktif', 'prestasi' => null],
            ['nama' => 'Dikie Pandu Winata', 'level' => 'Mula', 'jenisKelamin' => 'Pria', 'alamat' => 'Kota Jambi', 'tanggal_lahir' => '2011-07-15', 'idStable' => 2, 'status' => 'tidak_aktif', 'prestasi' => null],
            ['nama' => 'M.Rafa Rizalda', 'level' => 'Mula', 'jenisKelamin' => 'Pria', 'alamat' => 'Sarolangun', 'tanggal_lahir' => '2012-01-22', 'idStable' => 2, 'status' => 'aktif', 'prestasi' => null],

            // C. MARMER HORSE STABLE - idStable 3
            ['nama' => 'Ade Ramadhani', 'level' => 'Mula', 'jenisKelamin' => 'Wanita', 'alamat' => 'Tanjab Tim', 'tanggal_lahir' => '2009-09-02', 'idStable' => 3, 'status' => 'aktif', 'prestasi' => 'Juara 1 Lomba Berkuda Putri Tingkat Kabupaten 2023'],
            ['nama' => 'Intan Salsabila', 'level' => 'Mula', 'jenisKelamin' => 'Wanita', 'alamat' => 'Tanjab Tim', 'tanggal_lahir' => '2008-01-30', 'idStable' => 3, 'status' => 'aktif', 'prestasi' => null],
            ['nama' => 'Natasya Savaira', 'level' => 'Mula', 'jenisKelamin' => 'Wanita', 'alamat' => 'Muaro Jambi', 'tanggal_lahir' => '2007-11-17', 'idStable' => 3, 'status' => 'aktif', 'prestasi' => null],
            ['nama' => 'Raudatul Jannah', 'level' => 'Mula', 'jenisKelamin' => 'Wanita', 'alamat' => 'Muaro Jambi', 'tanggal_lahir' => '2007-05-27', 'idStable' => 3, 'status' => 'tidak_aktif', 'prestasi' => null],
            ['nama' => 'Tiara Anggraini', 'level' => 'Mula', 'jenisKelamin' => 'Wanita', 'alamat' => 'Tanjab Tim', 'tanggal_lahir' => '2008-09-02', 'idStable' => 3, 'status' => 'aktif', 'prestasi' => null],
            ['nama' => 'Adinda Suci Khairani', 'level' => 'Mula', 'jenisKelamin' => 'Wanita', 'alamat' => 'Kota Jambi', 'tanggal_lahir' => '2009-01-30', 'idStable' => 3, 'status' => 'aktif', 'prestasi' => 'Juara 3 Kejurda Berkuda 2024'],
            ['nama' => 'Hafy Ukarromah', 'level' => 'Mula', 'jenisKelamin' => 'Wanita', 'alamat' => 'Tanjab Bar', 'tanggal_lahir' => '2009-12-10', 'idStable' => 3, 'status' => 'aktif', 'prestasi' => null],
            ['nama' => 'Imelda Kayla Fadli', 'level' => 'Mula', 'jenisKelamin' => 'Wanita', 'alamat' => 'Tanjab Bar', 'tanggal_lahir' => '2009-02-22', 'idStable' => 3, 'status' => 'aktif', 'prestasi' => null],
            ['nama' => 'Miza Alzena', 'level' => 'Mula', 'jenisKelamin' => 'Wanita', 'alamat' => 'Sarolangun', 'tanggal_lahir' => '2009-12-26', 'idStable' => 3, 'status' => 'tidak_aktif', 'prestasi' => null],
            ['nama' => 'Najwa Esadora', 'level' => 'Mula', 'jenisKelamin' => 'Wanita', 'alamat' => 'Sarolangun', 'tanggal_lahir' => '2009-07-02', 'idStable' => 3, 'status' => 'aktif', 'prestasi' => null],
            ['nama' => 'Kharisma Indah Dwi', 'level' => 'Mula', 'jenisKelamin' => 'Wanita', 'alamat' => 'Tanjab Bar', 'tanggal_lahir' => '2008-04-30', 'idStable' => 3, 'status' => 'aktif', 'prestasi' => null],
            ['nama' => 'Siti Khirun Najwa', 'level' => 'Mula', 'jenisKelamin' => 'Wanita', 'alamat' => 'Tanjab Bar', 'tanggal_lahir' => '2008-05-25', 'idStable' => 3, 'status' => 'aktif', 'prestasi' => null],
            ['nama' => 'Afiah Nisa', 'level' => 'Mula', 'jenisKelamin' => 'Wanita', 'alamat' => 'Kota Jambi', 'tanggal_lahir' => '2010-05-01', 'idStable' => 3, 'status' => 'aktif', 'prestasi' => null],
            ['nama' => 'Hany Mirta Elvelin', 'level' => 'Mula', 'jenisKelamin' => 'Wanita', 'alamat' => 'Tanjab Bar', 'tanggal_lahir' => '2009-12-11', 'idStable' => 3, 'status' => 'aktif', 'prestasi' => null],
            ['nama' => 'Kheysara Mahira', 'level' => 'Mula', 'jenisKelamin' => 'Wanita', 'alamat' => 'Kota Jambi', 'tanggal_lahir' => '2010-02-01', 'idStable' => 3, 'status' => 'tidak_aktif', 'prestasi' => null],
            ['nama' => 'Letzia Vircha', 'level' => 'Mula', 'jenisKelamin' => 'Wanita', 'alamat' => 'Tanjab Bar', 'tanggal_lahir' => '2010-01-04', 'idStable' => 3, 'status' => 'aktif', 'prestasi' => null],
            ['nama' => 'Mahda Indana', 'level' => 'Mula', 'jenisKelamin' => 'Wanita', 'alamat' => 'Sarolangun', 'tanggal_lahir' => '2010-01-22', 'idStable' => 3, 'status' => 'aktif', 'prestasi' => null],
            ['nama' => 'Viviana Puspa', 'level' => 'Mula', 'jenisKelamin' => 'Wanita', 'alamat' => 'Tanjab Bar', 'tanggal_lahir' => '2009-10-02', 'idStable' => 3, 'status' => 'aktif', 'prestasi' => null],
            ['nama' => 'Alvina Shafiqah', 'level' => 'Mula', 'jenisKelamin' => 'Wanita', 'alamat' => 'Tanjab Bar', 'tanggal_lahir' => '2011-04-12', 'idStable' => 3, 'status' => 'aktif', 'prestasi' => null],
            ['nama' => 'Fina Nayla Husna', 'level' => 'Mula', 'jenisKelamin' => 'Wanita', 'alamat' => 'Tanjab Bar', 'tanggal_lahir' => '2011-03-23', 'idStable' => 3, 'status' => 'aktif', 'prestasi' => null],
            ['nama' => 'Putri Nur Bunga', 'level' => 'Mula', 'jenisKelamin' => 'Wanita', 'alamat' => 'Tanjab Bar', 'tanggal_lahir' => '2010-11-14', 'idStable' => 3, 'status' => 'aktif', 'prestasi' => null],

            // D. THE FREST STABLE JAMBI - idStable 4
            ['nama' => 'M.Rizki Aditya', 'level' => 'Mula', 'jenisKelamin' => 'Pria', 'alamat' => 'Batang Hari', 'tanggal_lahir' => '2012-12-14', 'idStable' => 4, 'status' => 'aktif', 'prestasi' => null],
            ['nama' => 'Muhammad Afif Marcelo Aris', 'level' => 'Mula', 'jenisKelamin' => 'Pria', 'alamat' => 'Tanjab Tim', 'tanggal_lahir' => '2012-03-26', 'idStable' => 4, 'status' => 'aktif', 'prestasi' => null],
            ['nama' => 'M.Helmi Dzahwan Mirza', 'level' => 'Mula', 'jenisKelamin' => 'Pria', 'alamat' => 'Muaro Jambi', 'tanggal_lahir' => '2012-02-12', 'idStable' => 4, 'status' => 'aktif', 'prestasi' => null],
            ['nama' => 'M.Dzaki Dzulfikar', 'level' => 'Mula', 'jenisKelamin' => 'Pria', 'alamat' => 'Batang Hari', 'tanggal_lahir' => '2011-10-27', 'idStable' => 4, 'status' => 'tidak_aktif', 'prestasi' => null],
            ['nama' => 'M.Adib Rifki', 'level' => 'Mula', 'jenisKelamin' => 'Pria', 'alamat' => 'Tanjab Bar', 'tanggal_lahir' => '2011-04-07', 'idStable' => 4, 'status' => 'aktif', 'prestasi' => null],
            ['nama' => 'M.Wildan Habibi', 'level' => 'Mula', 'jenisKelamin' => 'Pria', 'alamat' => 'Kota Jambi', 'tanggal_lahir' => '2009-09-09', 'idStable' => 4, 'status' => 'aktif', 'prestasi' => 'Juara 2 Lomba Berkuda Tingkat Kabupaten 2024'],
        ];

        foreach ($atlets as $atlet) {
            DB::table('atlet')->insert([
                'nama'          => $atlet['nama'],
                'level'         => $atlet['level'],
                'jenisKelamin'  => $atlet['jenisKelamin'],
                'alamat'        => $atlet['alamat'],
                'tanggal_lahir' => $atlet['tanggal_lahir'],
                'idStable'      => $atlet['idStable'],
                'status'        => $atlet['status'],
                'prestasi'      => $atlet['prestasi'],
                'created_at'    => now(),
                'updated_at'    => now(),
            ]);
        }
    }
}
