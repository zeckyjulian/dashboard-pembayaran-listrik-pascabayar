<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        // Jalankan semua seeder yang kamu miliki
        $this->call('LevelSeeder');
        $this->call('AdminSeeder');
        $this->call('TarifSeeder');
        $this->call('PelangganSeeder');
    }
}
