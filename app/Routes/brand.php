<?php 

use App\Controllers\BrandController;
$router->map(
    "GET",
    "/brand/list",
    [
        "method" => "list",
        "controller" => BrandController::class
    ],
    "brand-list"
);
$router->map(
    "GET",
    "/brand/add",
    [
        "method" => "add",
        "controller" => BrandController::class
    ],
    "brand-add"
);
$router->map(
    "POST",
    "/brand/add",
    [
        "method" => "create",
        "controller" => BrandController::class,
    ],
    "brand-create"
);
$router->map(
    "GET",
    "/brand/[i:id]/update",
    [
        "method" => "update",
        "controller" => BrandController::class,
    ],
    "brand-update",
);
$router->map(
    "POST",
    "/brand/[i:id]/update",
    [
        "method" => "edit",
        "controller" => BrandController::class,
    ],
    "brand-edit",
);

$router->map(
    "GET",
    "/brand/[i:id]/delete",
    [
        "method" => "delete",
        "controller" => BrandController::class,
    ],
    "brand-delete",
);