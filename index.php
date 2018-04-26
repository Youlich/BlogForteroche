<?php

require_once('services/Autoload.php');
Autoload::register();

\services\Config::start();

session_start();

$container = new \services\Container([]);
$router = new \router\Router($container);
$router->resolve();



