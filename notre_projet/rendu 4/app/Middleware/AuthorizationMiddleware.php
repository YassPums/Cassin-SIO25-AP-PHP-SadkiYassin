<?php

namespace App\Middleware;

class AuthorizationMiddleware
{
    public function verifierRole(string $role): void
    {
        if (!isset($_SESSION['idUtilisateur'])) {
            header('Location: /');
            exit;
        }

        if (($_SESSION['role'] ?? '') !== $role) {
            http_response_code(403);
            echo 'Accès interdit.';
            exit;
        }
    }
}
