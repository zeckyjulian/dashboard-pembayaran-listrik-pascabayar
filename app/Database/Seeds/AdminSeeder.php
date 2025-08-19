<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class AdminSeeder extends Seeder
{
    public function run()
    {
        $data = [
            [
                'username'       => 'admin_pln',
                'password'       => password_hash('admin123', PASSWORD_DEFAULT),
                'nama_admin'      => 'Budi',
                'id_level'       => 1,
            ],
            [
                'username'       => 'petugas_pln',
                'password'       => password_hash('petugas123', PASSWORD_DEFAULT),
                'nama_admin'      => 'Citra',
                'id_level'       => 2,
            ],
        ];

        $this->db->table('admin')->insertBatch($data);
    }
}
