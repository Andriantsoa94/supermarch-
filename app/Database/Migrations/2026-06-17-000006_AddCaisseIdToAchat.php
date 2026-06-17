<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddCaisseIdToAchat extends Migration
{
    public function up()
    {
        // SQLite n'autorise pas l'ajout d'une colonne NOT NULL sans valeur
        // par défaut sur une table existante : on fournit un default à 0.
        $this->forge->addColumn('achat', [
            'caisse_id' => [
                'type'       => 'INTEGER',
                'null'       => false,
                'default'    => 0,
            ],
        ]);
    }

    public function down()
    {
        $this->forge->dropColumn('achat', 'caisse_id');
    }
}
