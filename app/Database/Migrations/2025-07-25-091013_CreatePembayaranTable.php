<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreatePembayaranTable extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id_pembayaran' => ['type' => 'INT', 'constraint' => 11, 'unsigned' => true, 'auto_increment' => true],
            'id_tagihan' => ['type' => 'INT', 'constraint' => 11, 'unsigned' => true, 'null' => true],
            'id_pelanggan' => ['type' => 'INT', 'constraint' => 11, 'unsigned' => true, 'null' => true],
            'tanggal_pembayaran' => ['type' => 'DATETIME'],
            'bulan_bayar' => ['type' => 'INT', 'constraint' => 11],
            'biaya_admin' => ['type' => 'DECIMAL', 'constraint' => '10,2', 'default' => 2500.00],
            'total_bayar' => ['type' => 'DECIMAL', 'constraint' => '10,2'],
            'id_admin' => ['type' => 'INT', 'constraint' => 11, 'unsigned' => true, 'null' => true],
        ]);
        $this->forge->addKey('id_pembayaran', true);
        $this->forge->addForeignKey('id_tagihan', 'tagihan', 'id_tagihan', 'CASCADE', 'SET NULL');
        $this->forge->addForeignKey('id_pelanggan', 'pelanggan', 'id_pelanggan', 'CASCADE', 'SET NULL');
        $this->forge->addForeignKey('id_admin', 'admin', 'id_admin', 'CASCADE', 'SET NULL');
        $this->forge->createTable('pembayaran');
    }

    public function down()
    {
        $this->forge->dropTable('pembayaran');
    }
}
