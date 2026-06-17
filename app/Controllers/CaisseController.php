<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\CaisseModel;
use CodeIgniter\HTTP\ResponseInterface;

class CaisseController extends BaseController
{
    public function index()
    {
        function index() {
            $caisseModel = new CaisseModel();
            $allCaisse = $caisseModel->findAll();

            $data = [
                'titre'   => 'Choisir une caisse',
                'caisses' => $allCaisse
            ];

            return view('caisse/selection', $data);
        }
    }
}
