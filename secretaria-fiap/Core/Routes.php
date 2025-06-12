<?php
namespace Core;

class Routes
{
    public $routes = [];

    public function addRoute($httpMethod, $uri, $controller,)
    {
        if(is_string($controller)) {
            $data = [
                'class' => $controller,
                'method' => '__invoke'
            ];
        }

        if(is_array($controller)) {
            $data = [
                'class' => $controller[0],
                'method' => $controller[1]
            ];
        }

        $this->routes[$httpMethod][$uri] = $data;
    }

    public function get($uri, $controller) 
    {
        $this->addRoute('GET', $uri, $controller);

        return $this;
    }

    public function post($uri, $controller) 
    {
        $this->addRoute('POST', $uri, $controller);

        return $this;
    }

    public function run() 
    {
        $uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
        $httpMethod = $_SERVER['REQUEST_METHOD'];


        if(!isset($this->routes[$httpMethod][$uri])) {
            if (session_status() === PHP_SESSION_NONE) {
                session_start();
            }
            $_SESSION['erros'] = ['Rota não encontrada.'];
            header('Location: /');
            exit;
        }

        $routeInfo = $this->routes[$httpMethod][$uri];
        $class = $routeInfo['class'];
        $method = $routeInfo['method'];
        
        $c = new $class;
        $c->$method();

    }
}