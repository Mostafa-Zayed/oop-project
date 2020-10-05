<?php

namespace Core;

class Route
{
    public $routes = [];
    private $actions = ['index','create','store','edit','update','destroy'];

    public function get(string $url, string $controllerAction)
    {
        $parts= explode('@', trim($controllerAction));
        $this->routes[trim($url)] = [
            'method' => 'GET',
            'controller' => array_shift($parts),
            'action' => array_shift($parts),
            'name' => ''
        ];
        return $this;
    }

    public function post(string $url, string $controllerAction)
    {
        $parts= explode('@', $controllerAction);
        $this->routes[$url] = [
            'method' => 'POST',
            'controller' => array_shift($parts),
            'action' => array_shift($parts),
            'name' => ''
            
        ];
        return $this;
    }

    public function name(string $url)
    {
        foreach ($this->routes as $key => $route){
            if (empty($this->routes[$key]['name']))
                $this->routes[$key]['name'] = $url;
        }

    }
    public function resource(string $model, string $controller)
    {
        foreach ($this->actions as $action) {
            if ($action == 'index' || $action == 'edit' || $action == 'create')
                $this->get($model.'/'.$action,$controller.'@'.$action)->name($model.'.'.$action);
                
            else
                $this->post($model.'/'.$action,$controller.'@'.$action)->name($model.'.'.$action);
            
        }
        return $this;
    }

    public function except(string $url)
    {
        if (array_key_exists($url, $this->routes)) {
            unset($this->routes[$url]);
        }
    }

    public function isRoute(string $url): bool
    {
        return (array_key_exists($url, $this->routes));
    }
    public function getRoute(string $url)
    {
        return $this->isRoute($url) ? $this->routes[$url] : false;
    }

    public function getMethod(string $url)
    {
        return $this->getRoute($url) ? $this->routes[$url]['method'] : false;
    }
}
?>