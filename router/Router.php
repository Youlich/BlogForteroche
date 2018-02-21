// faire une classe Router, il a une methode diriger() en fonction de la route
on execute $frontend->listPosts(); ou $frontend->addComment($_GET['id'], $_POST['author'], $_POST['comment']);
// il a un attribute $routes c'est un tableau d'instances de Route.

<?php

namespace router;


class Router
{
    private $routes;

    public function diriger()
    {

    }
}