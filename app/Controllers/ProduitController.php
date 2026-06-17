<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;

class ProduitController extends BaseController
{
    public function index()
    {
        $produitModel = new produitModel();
        $allProduit = $produitModel->getAllProduit();

        return view('/achat/liste' ,$allProduit);
    }
}
