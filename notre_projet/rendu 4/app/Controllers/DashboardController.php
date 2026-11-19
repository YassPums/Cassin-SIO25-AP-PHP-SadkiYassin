<?php

namespace App\Controllers;

class DashboardController
{
    public function index(): void
    {
        if (!isset($_SESSION['idUtilisateur'])) {
            header('Location: /');
            exit;
        }

        switch ($_SESSION['role']) {
            case 'admin':
                $titre = 'Espace administrateur';
                break;

            case 'formateur':
                $titre = 'Espace formateur';
                break;

            case 'etudiant':
                $titre = 'Espace étudiant';
                break;

            default:
                http_response_code(403);
                echo 'Accès interdit.';
                return;
        }

        require __DIR__ . '/../Views/dashboard/index.php';
    }
}
