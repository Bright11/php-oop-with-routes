<?php
class Router
{
    private $routes = [];


    public function get($action, $callback)
    {
        $this->routes['GET'][$action] = $callback;
    }

    // post method to handle form submissions
    public function post($action, $callback)
    {
        $this->routes['POST'][$action] = $callback;
    }

    // resolve the request and call the appropriate callback
    public function resolve()
    {
        $method = $_SERVER['REQUEST_METHOD'];
        $action = $_GET['action'] ?? 'index'; // default action is index

        if (isset($this->routes[$method][$action])) {
            call_user_func($this->routes[$method][$action]);
        } else {
            // handle 404 error
            http_response_code(404);
            echo "404 - Route '{$action}' not found.";
        }
    }
}
