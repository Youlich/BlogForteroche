<?php
namespace router;
class Router
{
    private $container;
    private $request_uri;
    private $routes = [];

    public function __construct($container, $routes, $request_uri) {
        $this->container = $container;
        $this->routes = $routes;
        $this->request_uri = substr($request_uri, strpos($request_uri, "=") + 1);
    }
    public function resolve()
    {
        try {
            /* Backend */
            $params = [];

            if (isset($this->request_uri)) {
                if ($this->request_uri != 'BlogForteroche/index.php') {
                    if ($this->request_uri != 'BlogForteroche/') {
                        foreach ($this->routes as $pattern => $controllerAction) {
                            if (preg_match($pattern, $this->request_uri, $matches)) {
                                $controller = $this->routes[$pattern]['controller'];
                                $action = $this->routes[$pattern]['action'];
                                // params GET
                                foreach ($matches as $key => $value) {
                                    if ($key > 0) {
                                        $params[] = $value;
                                    }
                                }
                            }
                        }
                    }else {
                        $controller = 'getControllerFrontend';
                        $action = 'accueil';
                    }
                }else {
                    $controller = 'getControllerFrontend';
                    $action = 'accueil';
                }

            } else {
                $controller = 'getControllerFrontend';
                $action = 'accueil';
            }
            // params POST
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