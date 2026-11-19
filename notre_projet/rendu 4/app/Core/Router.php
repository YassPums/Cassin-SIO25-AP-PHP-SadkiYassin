<?php

namespace App\Core;

class Router
{
    private array $routes = [];

    public function ajouterRoute(
        string $methode,
        string $url,
        callable $action
    ): void {
        $this->routes[$methode][$url] = $action;
    }

    public function executer(string $methode, string $url): void
    {
        if (isset($this->routes[$methode][$url])) {
            $action = $this->routes[$methode][$url];
            $action();
        } else {
            http_response_code(404);
            echo 'Erreur 404 : Page introuvable';
        }
    }
}
