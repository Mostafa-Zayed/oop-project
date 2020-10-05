<?php
require_once '../helper.php';
require_once '../vendor/autoload.php';
require_once '../routes/web.php';
use Core\App; 
$app = new App($route);
//var_dump($app);

//pre($route->routes);
?>