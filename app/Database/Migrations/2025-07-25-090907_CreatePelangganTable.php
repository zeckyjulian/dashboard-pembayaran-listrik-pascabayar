<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreatePelangganTable extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id_pelanggan' => ['type' => 'INT', 'constraint' => 11, 'unsigned' => true, 'auto_increment' => true],
            'username' => ['type' => 'VARCHAR', 'constraint' => 100, 'unique' => true],
            'password' => ['type' => 'VARCHAR', 'constraint' => 255],
            'nomor_kwh' => ['type' => 'VARCHAR', 'constraint' => 12, 'unique' => true],
            'nama_pelanggan' => ['type' => 'VARCHAR', 'constraint' => 150],
            'alamat' => ['type' => 'TEXT'],
            'id_tarif' => ['type' => 'INT', 'constraint' => 11, 'unsigned' => true, 'null' => true],
        ]);
        $this->forge->addKey('id_pelanggan', true);
        $this->forge->addForeignKey('id_tarif', 'tarif', 'id_tarif', 'CASCADE', 'SET NULL');
        $this->forge->createTable('pelanggan');
    }

    public function down()
    {
        $this->forge->dropTable('pelanggan');
    }
}
