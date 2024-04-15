<?php
use App\Controllers\HomeController;
use App\Dashboard\DashboardController;
use Zems\Router;
use App\Model;

// var_dump(Router);
$router = new Router();

$router->get('/', HomeController::class, 'index');
$router->get('/dashboard', DashboardController::class, 'index');
$router->get('/about', HomeController::class, 'about');
$router->get('/model', Model::class, 'get');

$router->dispatch();