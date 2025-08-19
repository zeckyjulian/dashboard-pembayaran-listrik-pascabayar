<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreatePenggunaanTable extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id_penggunaan' => ['type' => 'INT', 'constraint' => 11, 'unsigned' => true, 'auto_increment' => true],
            'id_pelanggan' => ['type' => 'INT', 'constraint' => 11, 'unsigned' => true],
            'bulan' => ['type' => 'INT', 'constraint' => 11],
            'tahun' => ['type' => 'INT', 'constraint' => 11],
            'meter_awal' => ['type' => 'FLOAT'],
            'meter_akhir' => ['type' => 'FLOAT'],
        ]);
        $this->forge->addKey('id_penggunaan', true);
        $this->forge->addUniqueKey(['id_pelanggan', 'bulan', 'tahun']);
        $this->forge->addForeignKey('id_pelanggan', 'pelanggan', 'id_pelanggan', 'CASCADE', 'CASCADE');
        $this->forge->createTable('penggunaan');
    }

    public function down()
    {
        $this->forge->dropTable('penggunaan');
    }
}
