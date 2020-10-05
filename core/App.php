<?php

namespace Core;

class App 
{
    private $controllerName;
    private $actionName;

    public function __construct(Route $route)
    {
        $this->prepareURl($route);
        $this->renderUrl();
    }

    private function prepareUrl(Route $route): void
    {
        $url = $this->checkUrl();
        $method = (new Request)->server('REQUEST_METHOD');
        $routeUrl = $route->isRoute($url);
        if (! $routeUrl) {
            die('Page Not Found');
        } elseif ($method !== $route->getMethod($url)) {
            die('method is not exists');
        } else {
            $this->controllerName = $route->getController($url);
            $this->actionName = $route->getAction($url);
        }
    }

    private function renderUrl()
    {
        $className = "App\\Controllers\\".$this->controllerName;
        if (class_exists($className)) {
            $object = new $className;
            if (method_exists($object,$this->actionName)) {
                $action = $this->actionName;
                $object->$action();
            }
        } else {
            die("This Controller NOt Found");
        }
    }

    private function checkUrl()
    {
        /*if (isset((new Request)->server('PATH_INFO'))) {

        } else {
            return ''
        }*/
        return (string) ltrim((new Request)->server('PATH_INFO'),'/');
    }
}