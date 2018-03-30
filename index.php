<?php

require_once("controler/Autoload.php");
Autoload::register(); // j'appelle la fonction register de ma class Autoload

session_start();

$routerfrontend = new \router\RouterFrontend();
$routerfrontend->dirigerFrontend();
$routerbackend = new \router\RouterBackend();
$routerbackend->dirigerBackend();


