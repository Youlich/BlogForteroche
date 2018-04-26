<?php
namespace router;
use services\Mail;
class Router
{
    private $container;
    private $routes = [];
    public function __construct($container, $routes) {
        $this->container = $container;
        $this->routes = $routes;
    }
    public function resolve()
    {
        try {
            /* Backend */
            if (isset($_GET['action'])) {
                $controller = $this->routes[$_GET['action']]['controller'];
                $action = $this->routes[$_GET['action']]['action'];
            } else {
                $controller = 'getControllerFrontend';
                $action = 'accueil';
            }
            $params = [];
            if($_POST) {
                foreach ($_POST as $value) {
                    $params[] = $value;
                }
            }
        }
        catch
        (\Exception $e) {
            echo 'Erreur : ' . $e->getMessage();
        }
        return [
            'controller' => $controller,
            'action' => $action,
            'params' => $params,
        ];
    }
}