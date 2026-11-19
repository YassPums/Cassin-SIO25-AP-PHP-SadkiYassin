<?php

namespace App\Models;

use App\Core\Database;
use PDO;

class Utilisateur
{
    private PDO $connexion;

    public function __construct()
    {
        $database = new Database();
        $this->connexion = $database->getConnexion();
    }

    public function trouverParEmail(string $email): ?array
    {
        $sql = 'SELECT * FROM utilisateur WHERE email = :email';

        $requete = $this->connexion->prepare($sql);

        $requete->execute([
            'email' => $email
        ]);

        $utilisateur = $requete->fetch();

        if ($utilisateur === false) {
            return null;
        }

        return $utilisateur;
    }
}
