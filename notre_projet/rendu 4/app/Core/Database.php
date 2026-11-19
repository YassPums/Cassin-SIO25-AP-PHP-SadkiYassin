<?php
namespace App\Core;

use PDO;

class Database
{
    private PDO $connexion;

    public function __construct()
    {
        $config = require __DIR__ . '/../../config/database.php';

        $dsn = 'mysql:host=' . $config['host']
            . ';dbname=' . $config['dbname']
            . ';charset=' . $config['charset'];

        $this->connexion = new PDO(
            $dsn,
            $config['username'],
            $config['password']
        );

        $this->connexion->setAttribute(
            PDO::ATTR_ERRMODE,
            PDO::ERRMODE_EXCEPTION
        );

        $this->connexion->setAttribute(
            PDO::ATTR_DEFAULT_FETCH_MODE,
            PDO::FETCH_ASSOC
        );
    }

    public function getConnexion(): PDO
    {
        return $this->connexion;
    }
}
