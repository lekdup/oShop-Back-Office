<?php 

use App\Controllers\CategoryController;
$router->map(
    "GET",
    "/category/list",
    [
        "method" => "list",
        "controller" => CategoryController::class
    ],
    "category-list"
);
$router->map(
    "GET",
    "/category/add",
    [
        "method" => "add",
        "controller" => CategoryController::class
    ],
    "category-add"
);
$router->map(
    "POST",
    "/category/add",
    [
        "method" => "create",
        "controller" => CategoryController::class,
    ],
    "category-create"
);
$router->map(
    "GET",
    "/category/[i:id]/update",
    [
        "method" => "update",
        "controller" => CategoryController::class,
    ],
    "category-update",
);
$router->map(
    "POST",
    "/category/[i:id]/update",
    [
        "method" => "edit",
        "controller" => CategoryController::class,
    ],
    "category-edit",
);

$router->map(
    "GET",
    "/category/[i:id]/delete",
    [
        "method" => "delete",
        "controller" => CategoryController::class,
    ],
    "category-delete",
);
