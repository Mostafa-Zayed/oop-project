<?php


function __autoload($className)
{
    $filePath = lcfirst(str_replace('\\',DIRECTORY_SEPARATOR, $className)).'.php';
    if (file_exists($filePath))
        require_once $filePath;
}

spl_autoload_register("__autoload");
?>