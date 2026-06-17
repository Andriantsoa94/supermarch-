<?php

namespace App\Controllers;

use App\Models\AchatModel;
use App\Models\PanierModel;
use App\Models\ProduiModel;

class AchatController extends BaseController
{
    /**
     * Affiche le tableau récapitulatif des achats en cours pour la caisse active.
     */
    public function index()
    {
        $caisseId = session()->get('caisse_active');

        if (!$caisseId) {
            return redirect()->to('/caisse');
        }

        $achatModel  = new AchatModel();
        $produitModel = new ProduiModel();

        $achats = $achatModel->getAchatsEnCoursParCaisse((int) $caisseId);

        $total = 0;
        foreach ($achats as $a) {
            $total += $a['prix'] * $a['quantite'];
        }

        $data = [
            'titre'      => 'Saisie des achats',
            'achats'     => $achats,
            'produits'   => $produitModel->getAllProduit(),
            'total'      => $total,
            'caisse_id'  => $caisseId,
        ];

        return view('achats/saisie', $data);
    }

    /**
     * Ajoute un produit au panier de la caisse active, puis crée la ligne
     * d'achat correspondante avec le statut 'en_cours'.
     */
    public function ajouter()
    {
        $caisseId  = session()->get('caisse_active');
        $produitId = $this->request->getPost('produit_id');
        $quantite  = (int) $this->request->getPost('quantite');

        if (!$caisseId) {
            return redirect()->to('/caisse');
        }

        if (!$produitId || $quantite < 1) {
            return redirect()->to('/achats')->with('erreur', 'Produit ou quantité invalide.');
        }

        $panierModel = new PanierModel();
        $achatModel  = new AchatModel();

        $panierId = $panierModel->insert([
            'produit_id' => $produitId,
            'quantite'   => $quantite,
        ]);

        $achatModel->insert([
            'caisse_id' => $caisseId,
            'panier_id' => $panierId,
            'statut'    => 'en_cours',
        ]);

        return redirect()->to('/achats');
    }

    /**
     * Clôture l'achat en cours : passe le statut de toutes les lignes
     * 'en_cours' de la caisse active à 'cloture'.
     */
    public function cloturer()
    {
        $caisseId = session()->get('caisse_active');

        if (!$caisseId) {
            return redirect()->to('/caisse');
        }

        $achatModel = new AchatModel();
        $achatModel->cloturerParCaisse((int) $caisseId);

        return redirect()->to('/achats');
    }
}
