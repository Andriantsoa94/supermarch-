<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateUtilisateur extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => [
                'type'           => 'INTEGER',
                'auto_increment' => true,
            ],
            'nom' => [
                'type'       => 'VARCHAR',
                'null'       => false,
            ],
            'mot_de_passe' => [
                'type'       => 'TEXT',
                'null'       => false,
            ]
            
        ]);
        $this->forge->addKey('id', true);
        $this->forge->createTable('utilisateur');
    }

    public function down()
    {
        $this->forge->dropTable('utilisateur');
    }
}