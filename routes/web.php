<?php
use Core\Route;
$route = new Route;
$route->get('/','Homecontroller@index');
$route->resource('posts','Postcontroller');
pre($route->routes);