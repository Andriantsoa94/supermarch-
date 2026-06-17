<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateCaisse extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => [
                'type'           => 'INTEGER',
                'auto_increment' => true,
            ],
            'numero' => [
                'type'       => 'INTEGER',
                'null'       => false,
            ]
        ]);
        $this->forge->addKey('id', true);
        $this->forge->createTable('caisse');
    }

    public function down()
    {
        $this->forge->dropTable('caisse');
    }
}