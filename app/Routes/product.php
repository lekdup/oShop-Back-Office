<?php
use App\Controllers\ProductController;
$router->map(
    "GET",
    "/product/list",
    [
        "method" => "list",
        "controller" => ProductController::class
    ],
    "product-list"
);
$router->map(
    "GET",
    "/product/add",
    [
        "method" => "add",
        "controller" => ProductController::class
    ],
    "product-add"
);
$router->map(
    "POST",
    "/product/add",
    [
        "method" => "create",
        "controller" => ProductController::class
    ],
    "product-create,"
);
$router->map(
    "GET",
    "/product/[i:id]/update",
    [
        "method" => "update",
        "controller" => ProductController::class
    ],
    "product-update"
);
$router->map(
    "POST",
    "/product/[i:id]/update",
    [
        "method" => "edit",
        "controller" => ProductController::class
    ],
    "product-edit"
);
