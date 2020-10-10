<?php

namespace Core;

class Route
{
    public $routes = [];
    private $actions = ['index','create','store','edit','update','destroy'];
    private $controller ;
    private $action;
    private $params;

    public function get(string $url, string $controllerAction)
    {
        $parts= explode('@', trim($controllerAction));
        $urlRegular = "/^". str_replace('/','\/',$url) . "$/";
        $this->routes[trim($urlRegular)] = [
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
        $parts= explode('@', trim($controllerAction));
        $urlRegular = "/^". str_replace('/','\/',$url) . "$/";
        $this->routes[$urlRegular] = [
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
        $param = "([\d]+)";
        foreach ($this->actions as $action) {
            if ($action == 'index' || $action == 'edit' || $action == 'create') {
                if ($action == 'edit')
                $this->get($model.'/'.$action.'/'.$param,$controller.'@'.$action)->name($model.'.'.$action); 
                else
                $this->get($model.'/'.$action,$controller.'@'.$action)->name($model.'.'.$action);            
            } else {
                if ($action == 'update' || $action == 'destroy')
                    $this->post($model.'/'.$action.'/'.$param,$controller.'@'.$action)->name($model.'.'.$action); 
                else
                $this->post($model.'/'.$action,$controller.'@'.$action)->name($model.'.'.$action);
            }
        }
        return $this;
    }

    public function except(string $url)
    {
        if (array_key_exists($url, $this->routes)) {
            unset($this->routes[$url]);
        }
    }

    public function isMatch(string $url, string $method): bool
    {
        foreach ($this->routes as $route =>$info) {
            if (preg_match($route,$url,$matches)) {
                if ($method == $info['method']) {
                    $this->params = array_slice($matches,1);
                    $this->controller = $info['controller'];
                    $this->action = $info['action'];
                    return true;
                }
            }
        }
        return false;
    }

    public function getController()
    {
        return isset($this->controller) ? $this->controller : false ;
    }

    public function getAction()
    {
        return isset($this->action) ? $this->action : false ;
    }

    public function getParams()
    {
        return isset($this->params) ? $this->params : false ;
    }
}
?>