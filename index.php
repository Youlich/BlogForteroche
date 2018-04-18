<?php

require_once("_config.php");

MyAutoload::start();

require_once(CONTROLLER. '/Autoload.php');
Autoload::register(); // j'appelle la fonction register de ma class Autoload
//ces 2 lignes seront à supprimer quand le routeur sera prêt

session_start();

$router = new \router\Router();
$router->diriger();
//2 lignes à remplacer par celles-ci quand le routeur sera prêt
//$routeur = new Routeur($request)
//$routeur->renderController();

