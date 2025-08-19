<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class LevelSeeder extends Seeder
{
    public function run()
    {
        $data = [
            [
                'nama_level'       => 'Admin'
            ],
            [
                'nama_level'       => 'Petugas'
            ],
        ];

        $this->db->table('level')->insertBatch($data);
    }
}
