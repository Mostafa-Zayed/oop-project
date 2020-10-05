<?php

namespace Core;

class Route
{
    public $routes = [];

    public function get(string $url, string $controllerAction)
    {
        $parts= explode('@', $controllerAction);
        $this->routes = [
            'method' => 'GET',
            'controller' => array_shift($parts),
            'action' => array_shift($parts)
        ];
    }

    public function post(string $url, string $controllerAction)
    {
        $parts= explode('@', $controllerAction);
        $this->routes = [
            'method' => 'POST',
            'controller' => array_shift($parts),
            'action' => array_shift($parts)
        ];
    }
}
?>