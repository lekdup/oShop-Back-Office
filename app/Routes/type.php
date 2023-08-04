<?php 

use App\Controllers\TypeController;

$router->map(
    "GET",
    "/type/list",
    [
        "method" => "list",
        "controller" => TypeController::class
    ],
    "type-list",
);
$router->map(
    "GET",
    "/type/add",
    [
        "method" => "add",
        "controller" => TypeController::class
    ],
    "type-add"
);
$router->map(
    "POST",
    "/type/add",
    [
        "method" => "create",
        "controller" => TypeController::class,
    ],
    "type-create"
);
$router->map(
    "GET",
    "/type/[i:id]/update",
    [
        "method" => "update",
        "controller" => TypeController::class,
    ],
    "type-update",
);
$router->map(
    "POST",
    "/type/[i:id]/update",
    [
        "method" => "edit",
        "controller" => TypeController::class,
    ],
    "type-edit",
);

$router->map(
    "GET",
    "/type/[i:id]/delete",
    [
        "method" => "delete",
        "controller" => TypeController::class,
    ],
    "type-delete",
);