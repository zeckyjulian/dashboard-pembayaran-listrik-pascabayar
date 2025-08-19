<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateLevelTable extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id_level' => ['type' => 'INT', 'constraint' => 11, 'unsigned' => true, 'auto_increment' => true],
            'nama_level' => ['type' => 'VARCHAR', 'constraint' => 50],
        ]);
        $this->forge->addKey('id_level', true);
        $this->forge->createTable('level');
    }

    public function down()
    {
        $this->forge->dropTable('level');
    }
}
