<?php

namespace App\Controllers;

use App\Models\CaisseModel;

class CaisseController extends BaseController 
{
    public function index()
    {
        $caisseModel = new CaisseModel();
        $allCaisse = $caisseModel->findAll();

        $data = [
            'titre'   => 'Choisir une caisse',
            'caisses' => $allCaisse
        ];

        return view('caisse/selection', $data);
    }
}