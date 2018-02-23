<?php

require_once("controler/Autoload.php");
Autoload::register(); // j'appelle la fonction register de ma class Autoload
// on a plusieurs routes : par ex : listPosts, addComment, ect qui sont des instance de Route
// il faut un Routeur - en anglais Router
// faire une classe Router, il a une methode diriger() en fonction de la route on execute $frontend->listPosts(); ou $frontend->addComment($_GET['id'], $_POST['author'], $_POST['comment']);
// il a un attribute $routes c'est un tableau d'instances de Route.
// faire une classe Route
$router = new \router\Router();
$router->diriger();

