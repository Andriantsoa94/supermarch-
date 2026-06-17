<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AlterStatutAchatToVarchar extends Migration
{
    public function up()
    {
        $this->forge->modifyColumn('achat', [
            'statut' => [
                'name'       => 'statut',
                'type'       => 'VARCHAR',
                'constraint' => 20,
                'null'       => false,
                'default'    => 'en_cours',
            ],
        ]);
    }

    public function down()
    {
        $this->forge->modifyColumn('achat', [
            'statut' => [
                'name' => 'statut',
                'type' => 'INTEGER',
                'null' => false,
            ],
        ]);
    }
}
