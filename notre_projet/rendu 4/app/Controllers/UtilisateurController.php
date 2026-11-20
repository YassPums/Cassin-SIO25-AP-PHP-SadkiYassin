<?php

namespace App\Controllers;

use App\Models\Utilisateur;
use App\Middleware\AuthorizationMiddleware;

class UtilisateurController
{
    public function index(): void
    {
        $autorisation = new AuthorizationMiddleware();
        $autorisation->verifierRole('admin');

        $modele = new Utilisateur();
        $utilisateurs = $modele->trouverTous();

        require __DIR__ . '/../Views/admin/utilisateurs/index.php';
    }
}
