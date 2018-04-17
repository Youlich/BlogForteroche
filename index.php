<?php

require_once("_config.php");

require_once(CONTROLLER. 'Autoload.php');
Autoload::register(); // j'appelle la fonction register de ma class Autoload

session_start();

$router = new \router\Router();
$router->diriger();


