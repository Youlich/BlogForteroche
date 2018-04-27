<?php
require_once('services/Autoload.php');

Autoload::register();
\services\Config::start();
$routes = \services\Config::getRoutes();
session_start();

if ($_SERVER['REQUEST_URI'] == (HOST .'index.php')) {
    require (VIEWFRONT. 'accueil.php');
} else {
    $container = new \services\Container([]);
    $router = new \router\Router($container, $routes, $_SERVER['REQUEST_URI']);
    $resolve = $router->resolve();
    $caller = $resolve['controller'];
    $controller = $container->$caller();
    $action = $resolve['action'];
    call_user_func_array([$controller, $action], $resolve['params']);
}
