<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class DataSeeder extends Seeder
{
    public function run()
    {
        $this->db->table('utilisateur')->insert([
            'nom' => 'admin',
            'mot_de_passe' => password_hash('admin123', PASSWORD_DEFAULT),
        ]);

        $this->db->table('caisse')->insertBatch([
            ['numero' => 1],
            ['numero' => 2],
        ]);

        $this->db->table('produit')->insertBatch([
            [
                'designation' => 'Riz 5kg',
                'prix' => 12000,
                'stock' => 20,
            ],
            [
                'designation' => 'Sucre 1kg',
                'prix' => 3500,
                'stock' => 40,
            ],
            [
                'designation' => 'Lait 1L',
                'prix' => 5000,
                'stock' => 30,
            ],
            [
                'designation' => 'Huile 1L',
                'prix' => 9000,
                'stock' => 15,
            ],
            [
                'designation' => 'Savon',
                'prix' => 1500,
                'stock' => 50,
            ],
        ]);
    }
}
