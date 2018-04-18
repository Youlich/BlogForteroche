<?php
/**
 * Created by PhpStorm.
 * User: jutat
 * Date: 18/04/2018
 * Time: 09:59
 */

namespace router;

class Routeur
{
    private $request;
    private $routes = ["accueil.php" => ["controller" => "Frontend", "method" => "accueil" ]];

    public function __construct($request)
    {
        $this->request = $request;
    }

    public function renderController()
    {
        $request = $this->request;

        if (key_exists($request, $this->routes)) {
            $controller = $this->routes[$request]['controller'];
            $method = $this->routes[$request]['method'];

            $currentController = new $controller;
            $currentController->$method();
        }else{
            echo '404';
        }
    }
}