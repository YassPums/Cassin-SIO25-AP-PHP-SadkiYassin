<?php

use App\Core\Router;
use App\Controllers\AuthController;
use App\Controllers\DashboardController;

require_once __DIR__ . '/../vendor/autoload.php';

session_start();

$router = new Router();

$authController = new AuthController();
$dashboardController = new DashboardController();

$router->ajouterRoute('GET', '/', [
    $authController, 'afficherConnexion'
]);

$router->ajouterRoute('POST', '/connexion', [
    $authController, 'connexion'
]);

$router->ajouterRoute('POST', '/deconnexion', [
    $authController, 'deconnexion'
]);

$router->ajouterRoute('GET', '/dashboard', [
    $dashboardController, 'index'
]);

$url = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
$methode = $_SERVER['REQUEST_METHOD'];

$router->executer($methode, $url);
