<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateTarifTable extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id_tarif' => ['type' => 'INT', 'constraint' => 11, 'unsigned' => true, 'auto_increment' => true],
            'daya' => ['type' => 'VARCHAR', 'constraint' => 20],
            'tarifperkwh' => ['type' => 'DECIMAL', 'constraint' => '10,2'],
        ]);
        $this->forge->addKey('id_tarif', true);
        $this->forge->createTable('tarif');
    }

    public function down()
    {
        $this->forge->dropTable('tarif');
    }
}
