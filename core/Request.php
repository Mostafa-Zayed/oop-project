<?php 

namespace Core;

class Request
{

	/**
     * get value from $_GET array by key
     * 
     * @param string $key
     * @return mixed
     */
    public function get(string $key, $value = null)
    {
        return $_GET[$key] = ($value) ? $value : (isset($_GET[$key])) ? $_GET[$key] : $value;
    }
    
    /**
     * get value from $_POST array by key
     * 
     * @param string $key
     * @return mixed
     */
    public function post(string $key, $value = null)
    {
        return $_POST[$key] = ($value) ? $value : isset($_POST[$key]) ? $_POST[$key] : $value;
    }

    public function server(string $key)
    {
        return isset($_SERVER[$key]) ? $_SERVER[$key] : null;
    }

    public function serverAll()
    {
        return $_SERVER;
    }
}