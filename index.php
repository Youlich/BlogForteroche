<?php

require_once('services\Autoload.php');
Autoload::register();

\services\Config::start();

session_start();

//on peut utiliser des paramètres
//$tableau = [
//////];
// et changer cette ligne :
//$container = new \services\Container([$tableau]);

$container = new \services\Container([]);
$router = new \router\Router($container);
$router->diriger();


