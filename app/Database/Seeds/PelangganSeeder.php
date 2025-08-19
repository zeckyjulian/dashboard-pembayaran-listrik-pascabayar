<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class PelangganSeeder extends Seeder
{
    public function run()
    {
        $data = [
            [
                'username'       => 'andibudi',
                'password'       => password_hash('password123', PASSWORD_DEFAULT),
                'nomor_kwh'      => '123456789011',
                'nama_pelanggan' => 'Andi Budianto',
                'alamat'         => 'Jl. Merdeka No. 10, Jakarta',
                'id_tarif'       => 1, // Asumsi id_tarif 1 adalah untuk 900 VA
            ],
            [
                'username'       => 'citraayu',
                'password'       => password_hash('rahasia456', PASSWORD_DEFAULT),
                'nomor_kwh'      => '123456789012',
                'nama_pelanggan' => 'Citra Ayu Lestari',
                'alamat'         => 'Jl. Pahlawan No. 25, Bandung',
                'id_tarif'       => 2, // Asumsi id_tarif 2 adalah untuk 1300 VA
            ],
            [
                'username'       => 'dewisita',
                'password'       => password_hash('amansekali', PASSWORD_DEFAULT),
                'nomor_kwh'      => '123456789013',
                'nama_pelanggan' => 'Dewi Sita',
                'alamat'         => 'Jl. Gatot Subroto No. 5, Surabaya',
                'id_tarif'       => 2, // Asumsi id_tarif 2 adalah untuk 1300 VA
            ],
        ];

        $this->db->table('pelanggan')->insertBatch($data);
    }
}
