<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreatePanier extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => [
                'type'           => 'INTEGER',
                'auto_increment' => true,
            ],
            'produit_id' => [
                'type'       => 'INTEGER',
                'null'       => false,
            ],
            
            'quantite' => [
                'type'       => 'INTEGER',
                'null'       => false,
            ]
            
        ]);
        $this->forge->addKey('id', true);
        $this->forge->addForeignKey('produit_id', 'produit', 'id', 'CASCADE', 'CASCADE');
        $this->forge->createTable('panier');
    }

    public function down()
    {
        $this->forge->dropTable('panier');
    }
}