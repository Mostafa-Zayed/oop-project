<?php

namespace Core;

class View
{
    public static function load(string $path, $data = [])
    {
        $path = '../app/Views/'.$path.'.php';
        if (file_exists($path))
            extract($data);
            require_once $path;
    }
}