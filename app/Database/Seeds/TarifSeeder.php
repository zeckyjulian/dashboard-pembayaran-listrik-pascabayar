<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class TarifSeeder extends Seeder
{
    public function run()
    {
        $data = [
            [
                'daya'         => '900 VA',
                'tarifperkwh'  => 1352.00,
            ],
            [
                'daya'         => '1300 VA',
                'tarifperkwh'  => 1444.70,
            ],
            [
                'daya'         => '2200 VA',
                'tarifperkwh'  => 1444.70,
            ],
            [
                'daya'         => '3500 VA',
                'tarifperkwh'  => 1699.53,
            ],
            [
                'daya'         => '6600 VA',
                'tarifperkwh'  => 1699.53,
            ],
        ];

        // Insert batch ke tabel tarif
        $this->db->table('tarif')->insertBatch($data);
    }
}
