<?php
// FrontController

require_once '../vendor/autoload.php';

session_start();

use App\Controllers\MainController;

/* ------------
--- ROUTAGE ---
-------------*/

$router = new AltoRouter();

if (array_key_exists('BASE_URI', $_SERVER)) {
    $router->setBasePath($_SERVER['BASE_URI']);
} else {
    $_SERVER['BASE_URI'] = '/';
}

$router->map(
    'GET',
    '/',
    [
        'method' => 'home',
        'controller' =>  MainController::class 
    ],
    'main-home'
);
require_once "../app/Routes/category.php";
require_once "../app/Routes/product.php";
require_once "../app/Routes/user.php";
require_once "../app/Routes/home-order.php";
require_once "../app/Routes/brand.php";
require_once "../app/Routes/type.php";
/* -------------
--- DISPATCH ---
--------------*/

$match = $router->match();
// dump($router->match()["name"]);
$dispatcher = new Dispatcher($match, '\App\Controllers\ErrorController::err404');

$dispatcher->setControllersArguments( $router, $match );
// Une fois le "dispatcher" configuré, on lance le dispatch qui va exécuter la méthode du controller
$dispatcher->dispatch();
