<?php

namespace Core;

class App 
{
    private $controllerName;
    private $actionName;
    private $params;
    public function __construct()
    {
        $this->prepareUrl();
        $this->renderUrl();
    }

    private function prepareUrl()
    {
        global $route;
        $url = $this->checkUrl();
        $method = (new Request)->server('REQUEST_METHOD');
        $routeUrl = $route->isMatch($url,$method);
        if ($routeUrl) {
            $this->controllerName = $route->getcontroller();
            $this->actionName = $route->getAction();
            $this->params = $route->getParams();
        }
    }

    private function renderUrl()
    {
        $className = "App\\Controllers\\".$this->controllerName;
        if (class_exists($className)) {
            $object = new $className;
            if (method_exists($object,$this->actionName)) {
                call_user_func_array([$className,$this->actionName],$this->params);
                //$action = $this->actionName;
                //$object->$action();
            }
        } else {
            die("This Controller NOt Found");
        }
    }

    private function checkUrl()
    {
        return trim((new Request)->server('QUERY_STRING'));
    }
}