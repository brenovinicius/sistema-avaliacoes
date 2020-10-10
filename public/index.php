<?php

require __DIR__ . "/../vendor/autoload.php";

use CoffeeCode\Router\Router;

// Instanciando o Router
$router = new Router(APP_URL);

//Configuração do namespace dos controllers
$router->namespace("App\Controllers");

// App Controller (default controller)
$router->group(null);
$router->get("/", "AppController:index");

// Errors Handler
$router->group("error");
$router->get("/{code}", "AppController:error");

// Router Dispatcher
$router->dispatch();

// Redirecionamento para páginas de erro
if ($router->error()) {
    $router->redirect("/error/{$router->error()}");
}