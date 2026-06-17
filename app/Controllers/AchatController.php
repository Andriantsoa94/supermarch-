<?php 

namespace App\Controllers;

use App\Models\ProduiModel;

class AchatController extends BaseController
{

    public function index()
    {
        $data = [
            'titre' => 'Liste des achats',
        ];

        $modelProduit = new ProduiModel();
        $data['produits'] = $modelProduit->findAll();

        return view('achat/liste', $data);
    }

    // public function ajouter()
    // {
    //     $produitId = $this->request->getPost('produit_id');
    //     $quantite = $this->request->getPost('quantite');

    //     // Logique pour ajouter le produit à l'achat en cours
    //     // Vous pouvez stocker les achats dans la session ou dans une table temporaire

    //     return redirect()->to('/achats');
    // }

    // public function cloturer()
    // {
    //     // Logique pour finaliser l'achat et enregistrer les détails dans la base de données

    //     return redirect()->to('/achats');
    // }
}