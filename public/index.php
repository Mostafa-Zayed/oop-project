<?php
require_once '../helper.php';
require_once '../vendor/autoload.php';
require_once '../routes/web.php';
use Core\Validation\Validator;
use Core\App; 
//$app = new App();

$req = [
    [
        'name' => 'username',
        'value' => 'mostafa$yahoo.com',
        'rules' => 'required|email'
    ], 

    [
        'name' => 'age',
        'value' => '',
        'rules' => 'required|numeric'
    ], 
];

$errors = Validator::make($req);
print_r($errors);

?>