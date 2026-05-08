<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class StableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $stables = [
            [
                'idKabupaten' => 1,
                'nama' => 'Al Hidayah Horse Stable (AHS)',
                'mulai_berdiri' => 2021,
                'pemilik' => 'Pondok Pesantren Karya Pembangunan Al Hidayah Jambi',
                'alamat_ktp_pemilik' => 'Jln Marsda Surya Dharma, Kenali Asam, KM.10, Kota Baru, Kota Jambi',
                'alamat_stable' => 'Jln Marsda Surya Dharma, Kenali Asam, KM.10, Kota Baru, Kota Jambi',
                'pimpinan_stable' => 'Direktur Pondok Karya Pembangunan Al Hidayah Provinsi Jambi',
                'no_akte_badan_hukum' => NULL,
                'no_pengesahan_kumham' => NULL,
                'domisili_badan_hukum' => 'Jambi',
                'npwp' => NULL,
                'jumlah_kandang' => NULL,
            ],
            [
                'idKabupaten' => 3,
                'nama' => 'JOKO TINGKIR STABLE',
                'mulai_berdiri' => 2020,
                'pemilik' => 'H. Zulkhoiri',
                'alamat_ktp_pemilik' => 'Perum Grand Kenali Kota Jambi',
                'alamat_stable' => 'Kel.Jembatan Mas ,kec.Pemayung,Kab.Batanghari,Prov.Jambi',
                'pimpinan_stable' => 'Ust. Muhaimin',
                'no_akte_badan_hukum' => 'AHU-0000639.AH.01.12.Tahun 2019',
                'no_pengesahan_kumham' => 'AHU-0000489.AH.01.04.Tahun 2019',
                'domisili_badan_hukum' => 'Kel.Jembatan Mas ,kec.Pemayung,Kab.Batanghari,Prov.Jambi',
                'npwp' => '90.231.043.2-335.000',
                'jumlah_kandang' => 3,
            ],
            [
                'idKabupaten' => 2,
                'nama' => 'MARMER HORSE STABLE',
                'mulai_berdiri' => 2019,
                'pemilik' => 'Nur Subiyantoro, SE.',
                'alamat_ktp_pemilik' => 'Jln. Tanjung Harapan no.42 Rt.20 Kel.Tlg Bakung Kec. Paal Merah Kota Jambi',
                'alamat_stable' => 'Jln Tambak Sari 1 No.66 Rt.09 Desa Tangkit Kec. Sungai gelam Kab. Muaro Jambi',
                'pimpinan_stable' => 'Nur Subiyantoro, SE.',
                'no_akte_badan_hukum' => NULL,
                'no_pengesahan_kumham' => NULL,
                'domisili_badan_hukum' => NULL,
                'npwp' => '57.313.610.8-331.000',
                'jumlah_kandang' => 4,
            ],
            [
                'idKabupaten' => 1,
                'nama' => 'THE FREST STABLE JAMBI',
                'mulai_berdiri' => NULL,
                'pemilik' => 'MUHAMMAD ICHSAN, S.Kom',
                'alamat_ktp_pemilik' => NULL,
                'alamat_stable' => 'JLN.TAMAN KOTA, KENALI ASAM BAWAH, KEC.KOTA BARU, KOTA JAMBI',
                'pimpinan_stable' => 'MUHAMMAD ICHSAN, S.Kom',
                'no_akte_badan_hukum' => NULL,
                'no_pengesahan_kumham' => NULL,
                'domisili_badan_hukum' => NULL,
                'npwp' => NULL,
                'jumlah_kandang' => NULL,
            ],
        ];

        foreach ($stables as $stable) {
            DB::table('stable')->insert([
                'idKabupaten' => $stable['idKabupaten'],
                'nama' => $stable['nama'],
                'mulai_berdiri' => $stable['mulai_berdiri'],
                'pemilik' => $stable['pemilik'],
                'alamat_ktp_pemilik' => $stable['alamat_ktp_pemilik'],
                'alamat_stable' => $stable['alamat_stable'],
                'pimpinan_stable' => $stable['pimpinan_stable'],
                'no_akte_badan_hukum' => $stable['no_akte_badan_hukum'],
                'no_pengesahan_kumham' => $stable['no_pengesahan_kumham'],
                'domisili_badan_hukum' => $stable['domisili_badan_hukum'],
                'npwp' => $stable['npwp'],
                'jumlah_kandang' => $stable['jumlah_kandang'],
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
