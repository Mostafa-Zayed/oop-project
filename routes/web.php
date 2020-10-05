<?php
use Core\Route;
$route = new Route;
$route->resource('posts','PostControlelr');

//echo var_dump($route->getMethod('posts/store'));