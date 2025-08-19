<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateTagihanTable extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id_tagihan' => ['type' => 'INT', 'constraint' => 11, 'unsigned' => true, 'auto_increment' => true],
            'id_penggunaan' => ['type' => 'INT', 'constraint' => 11, 'unsigned' => true, 'null' => true],
            'id_pelanggan' => ['type' => 'INT', 'constraint' => 11, 'unsigned' => true, 'null' => true],
            'bulan' => ['type' => 'INT', 'constraint' => 11],
            'tahun' => ['type' => 'INT', 'constraint' => 11],
            'jumlah_meter' => ['type' => 'FLOAT'],
            'status' => ['type' => 'VARCHAR', 'constraint' => 20, 'default' => 'Belum Bayar'],
        ]);
        $this->forge->addKey('id_tagihan', true);
        $this->forge->addForeignKey('id_penggunaan', 'penggunaan', 'id_penggunaan', 'CASCADE', 'SET NULL');
        $this->forge->addForeignKey('id_pelanggan', 'pelanggan', 'id_pelanggan', 'CASCADE', 'SET NULL');
        $this->forge->createTable('tagihan');
    }

    public function down()
    {
        $this->forge->dropTable('tagihan');
    }
}
