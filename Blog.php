<?php
require_once("controler/Autoload.php");

Autoload::register(); // j'appelle la fonction register de ma class Autoload
$frontend = new \controler\Frontend();
// on a plusieurs routes : par ex : listPosts, addComment, ect qui sont des instance de Route
// il faut un Routeur - en anglais Router
// faire une classe Router, il a une methode diriger() en fonction de la route on execute $frontend->listPosts(); ou $frontend->addComment($_GET['id'], $_POST['author'], $_POST['comment']);
// il a un attribute $routes c'est un tableau d'instances de Route.
// faire une classe Route

try {
    if (isset($_GET['action'])) {
        if ($_GET['action'] == 'listPosts') { // c'est l'action par défaut , la fonction qui affiche tous les posts et qui est détaillée dans le frontend.php
            $frontend->listPosts();
        } elseif ($_GET['action'] == 'post') { // action qui se réalise quand on clique sur le lien "lire la suite"
            if (isset($_GET['id']) && $_GET['id'] > 0) {
                $frontend->post(); // fonction post de frontend.php
            } else {
                throw new Exception('Aucun identifiant de billet envoyé');
            }
        }elseif ($_GET['action'] == 'addComment') {
            if (isset($_GET['id']) && $_GET['id'] > 0) {
                if (!empty($_POST['author']) && !empty($_POST['comment'])) {
                    $frontend->addComment($_GET['id'], $_POST['author'], $_POST['comment']);
                } else {
                    throw new Exception('Tous les champs ne sont pas remplis !');
                }
            } else {
                throw new Exception('Aucun identifiant de billet envoyé');
            }
        } elseif ($_GET['action'] == 'Comment'){ // si on clique sur le lien modifier du commentaire
            if (isset($_GET['numComm']) && $_GET['numComm'] > 0) {
                $frontend->comment(); // fonction comment utilisée
            } else {
                throw new Exception('Aucun identifiant de commentaire envoyé');
            }
        }
        elseif ($_GET['action'] == 'ModifComment'){
            if (isset($_GET['numComm']) && $_GET['numComm'] > 0) {
                if (!empty($_POST['author']) && !empty($_POST['comment'])) {
                    $frontend->ModifComment();
                } else {
                    throw new Exception('Tous les champs ne sont pas remplis !');
                }
            } else {
                throw new Exception('Aucun identifiant de billet envoyé');
            }
        }
    } else {
        $frontend->listPosts(); // fonction par défaut détaillée dans frontend.php
    }
}
catch(Exception $e) {
    echo 'Erreur : ' . $e->getMessage();
}
