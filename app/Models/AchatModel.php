<?php

namespace App\Models;

use CodeIgniter\Model;

class AchatModel extends Model
{
    protected $table            = 'achat';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = ['caisse_id', 'panier_id', 'statut'];

    protected bool $allowEmptyInserts = false;
    protected bool $updateOnlyChanged = true;

    protected array $casts = [];
    protected array $castHandlers = [];

    // Dates
    protected $useTimestamps = false;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';

    // Validation
    protected $validationRules      = [];
    protected $validationMessages   = [];
    protected $skipValidation       = false;
    protected $cleanValidationRules = true;

    // Callbacks
    protected $allowCallbacks = true;
    protected $beforeInsert   = [];
    protected $afterInsert    = [];
    protected $beforeUpdate   = [];
    protected $afterUpdate    = [];
    protected $beforeFind     = [];
    protected $afterFind      = [];
    protected $beforeDelete   = [];
    protected $afterDelete    = [];

    /**
     * Retourne les achats "en_cours" de la caisse, avec le détail du produit
     * (designation, prix, quantite) pour affichage dans le tableau récapitulatif.
     */
    public function getAchatsEnCoursParCaisse(int $caisseId): array
    {
        return $this->select('achat.id, achat.statut, panier.quantite, produit.id as produit_id, produit.designation, produit.prix')
            ->join('panier', 'panier.id = achat.panier_id')
            ->join('produit', 'produit.id = panier.produit_id')
            ->where('achat.caisse_id', $caisseId)
            ->where('achat.statut', 'en_cours')
            ->findAll();
    }

    /**
     * Passe tous les achats "en_cours" d'une caisse au statut "cloture".
     */
    public function cloturerParCaisse(int $caisseId): bool
    {
        return $this->where('caisse_id', $caisseId)
            ->where('statut', 'en_cours')
            ->set(['statut' => 'cloture'])
            ->update();
    }
}
