<?php

namespace App\Controllers;

use App\Models\Utilisateur;

class AuthController
{
    public function afficherConnexion(): void
    {
        $erreur = null;

        $_SESSION['csrf_token'] ??= bin2hex(random_bytes(32));

        require __DIR__ . '/../Views/auth/connexion.php';
    }

    public function connexion(): void
    {
        $email = trim($_POST['email'] ?? '');
        $motDePasse = $_POST['motDePasse'] ?? '';

        if (!isset($_SESSION['csrf_token']) ||
            !hash_equals($_SESSION['csrf_token'], $_POST['csrf_token'] ?? '')) {
            http_response_code(403);
            echo 'Requête non autorisée.';
            return;
        }

        $modele = new Utilisateur();
        $utilisateur = $modele->trouverParEmail($email);

        if ($utilisateur !== null &&
            password_verify($motDePasse, $utilisateur['mdpHash'])) {

            session_regenerate_id(true);

            $_SESSION['idUtilisateur'] = $utilisateur['idUtilisateur'];
            $_SESSION['nom'] = $utilisateur['nom'];
            $_SESSION['prenom'] = $utilisateur['prenom'];
            $_SESSION['role'] = $utilisateur['role'];

            header('Location: /dashboard');
            exit;
        }

        $erreur = 'Email ou mot de passe incorrect.';

        require __DIR__ . '/../Views/auth/connexion.php';
    }

    public function deconnexion(): void
    {
        if (!isset($_SESSION['csrf_token']) ||
            !hash_equals($_SESSION['csrf_token'], $_POST['csrf_token'] ?? '')) {
            http_response_code(403);
            return;
        }

        $_SESSION = [];
        session_destroy();

        header('Location: /');
        exit;
    }
}
