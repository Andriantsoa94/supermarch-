<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\UtilisateurModel; 

class AuthController extends BaseController
{
    public function login()
    {
        if (session()->get('isLoggedIn')) {
            return redirect()->to('/caisse');
        }

        return view('auth/login');
    }

    public function authentifier()
    {
        $session = session();
        $model = new UtilisateurModel();

        $username = $this->request->getPost('username');
        $password = $this->request->getPost('password');

        $user = $model->where('nom', $username)->first();

        if ($user && password_verify($password, $user['mot_de_passe'])) {
            $session->set([
                'id_user'    => $user['id'],
                'username'   => $user['nom'],
                'isLoggedIn' => true,
            ]);

            return redirect()->to('/caisse');
        }

        return view('auth/login', ['erreur' => 'Identifiants incorrects.']);
    }

    public function logout()
    {
        session()->destroy();
        return redirect()->to('/');
    }
}