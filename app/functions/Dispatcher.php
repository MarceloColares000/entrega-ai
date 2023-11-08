<?php

namespace App\Functions;

// Classe despachante
class Dispatcher {
    private $routes = [];

    public function addRoute($url, $controller, $action) {
        $this->routes[$url] = ['controller' => $controller, 'action' => $action];
    }

    public function dispatch($url) {

        $urlParts = explode('/', $url);

        foreach ($this->routes as $route => $info) {
            $params = $this->extractParams($route, $url);

            if ($params !== null) {
                $controllerClass = $info['controller'];
                $action = $info['action'];
                $controller = new $controllerClass();

                $args = [];
                foreach ($params as $paramName => $paramValue) {
                    $args[] = $paramValue;
                }

                if (method_exists($controller, $action)) {
                    call_user_func_array([$controller, $action], $args);
                    return true; // Indica que uma rota foi encontrada
                } else {
                    //echo "O método não foi encontrado: $action<br>";
                }
            }
        }

        return false; // Indica que nenhuma rota foi encontrada
    }

    // Extrai os valores da URL
    private function extractParams($route, $url) {
        $routeParts = explode('/', $route);
        $urlParts = explode('/', $url);

        if (count($routeParts) !== count($urlParts)) {
            return null;
        }

        $params = [];

        for ($i = 0; $i < count($routeParts); $i++) {
            if (strpos($routeParts[$i], '{') === 0 && strpos($routeParts[$i], '}') === strlen($routeParts[$i]) - 1) {
                $paramName = trim($routeParts[$i], '{}');
                $params[$paramName] = $urlParts[$i];
            } elseif ($routeParts[$i] !== $urlParts[$i]) {
                return null;
            }
        }

        return $params;
    }
    
}
