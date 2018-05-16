<?php
require_once( 'services/Autoload.php' );
// on fait appel à la fonction register de la classe Autoload qui permet l'autochargement des classes
Autoload::register();
// on appelle la fonction start afin d'obtenir les chemins vers les fichiers de façon simplifiée
\services\Config::start();
// // on appelle la fonction getRoutes qui permet d'avoir les routes en fonction d'un mot obtenu dans l'url
// grâce à cette fonction on obtient le nom de la fonction du Container
// le container permet l'injection de dépendances entre les controllers et les models
$routes = \services\Config::getRoutes();
// Démarre une session
session_start();
// On fait appelle à la classe Container pour pouvoir utiliser ses fonctions dont les infos de connexions à la BDD
$container = new \services\Container(\services\Config::getConfigBDD());
// On fait appelle à la classe Router en lui donnant les iformations utiles pour fonctionner : le container de dépendances (entre controllers et models) et la liste des routes
$router = new \router\Router($container, $routes, $_SERVER['REQUEST_URI']);
//le routeur pourra résoudre les demandes d'urls des visiteurs en nous donnant l'action et le controller
$resolve = $router->resolve();
$caller = $resolve['controller'];
$controller = $container->$caller();
$action = $resolve['action'];
//on fait appelle aux fonctions pour qu'elles soient exécutées
call_user_func_array([$controller, $action], $resolve['params']);
