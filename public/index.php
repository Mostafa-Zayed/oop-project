<?php
require_once '../helper.php';
require_once '../vendor/autoload.php';
use Core\Request;
use Core\Route;

$route = new Route;

$route->get('posts/index','TestController@index')->name('test.index');
$route->get('posts/create','PostController@create');
$route->post('posts/store','PostController@store');
$route->post('posts/edit','PostsController@edit');
$route->resource('posts','PostController');
pre($route->routes);

?>