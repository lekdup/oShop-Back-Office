<?php

use App\Controllers\UserController;

$router->map(
    "GET",
    "/login",
    [
        "method" => "login",
        "controller" => UserController::class
    ],
    "user-login"
);
$router->map(
    "POST",
    "/login",
    [
        "method" => "login_post",
        "controller" => UserController::class
    ],
    "user-login-post"
);
$router->map(
    "GET",
    "/logout",
    [
        "method" => "logout",
        "controller" => UserController::class
    ],
    "user-logout"
);

//-------------------------------------------------------

$router->map(
    "GET",
    "/user/list",
    [
        "method" => "list",
        "controller" => UserController::class
    ],
    "user-list"
);
$router->map(
    "GET",
    "/user/add",
    [
        "method" => "add",
        "controller" => UserController::class
    ],
    "user-add"
);
$router->map(
    "POST",
    "/user/add",
    [
        "method" => "create",
        "controller" => UserController::class
    ],
    "user-create"
);
$router->map(
    "GET",
    "/user/[i:id]/update",
    [
        "method" => "update",
        "controller" => UserController::class
    ],
    "user-update"
);
$router->map(
    "POST",
    "/user/[i:id]/update",
    [
        "method" => "edit",
        "controller" => UserController::class
    ],
    "user-edit"
);
$router->map(
    "GET",
    "/user/[i:id]/delete",
    [
        "method" => "delete",
        "controller" => UserController::class
    ],
    "user-delete"
);
