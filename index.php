<?php
require_once('services/Autoload.php');
Autoload::register();
\services\Config::start();
$routes = \services\Config::getRoutes();
session_start();
$container = new \services\Container([]);
$router = new \router\Router($container, $routes);
$resolve = $router->resolve();
$caller = $resolve['controller'];
$controller = $container->$caller();
$action = $resolve['action'];
call_user_func_array([$controller, $action], $resolve['params']);