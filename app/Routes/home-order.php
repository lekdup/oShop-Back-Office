<?php

use App\Controllers\HomeOrderController;

$router->map(
    "GET",
    "/home/order",
    [
        "method" => "order",
        "controller" => HomeOrderController::class
    ],
    "home-order"
);
$router->map(
    "POST",
    "/home/order",
    [
        "method" => "updateOrder",
        "controller" => HomeOrderController::class
    ],
    "home-order-update"
);
