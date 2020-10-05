<?php

namespace Core;

class Session
{
	/**
	* invoke start function to check session
	*
	* @return mixed
	*/
	public function __construct()
	{
		$this->start();
	}
	/**
	* check session id and start session
	* 
	* @return string
	*/
	public function start(): string
	{
		ini_set('session.use_only_cookies', 1);
		return ! session_id() ? session_start() : session_id();
	}

	/**
	* put value in session array
	*
	* @param string $key
	* @param mixed  $value
	* @return void 
	**/
	function set(string $key, $value): void
	{
		$_SESSION[$key] = $value;
	}

	/**
	* return value from session array by key
	* 
	* @param string $key
	* @return mixed
	*/
	function get(string $key)
	{
		return $this->has($key) ? $_SESSION[$key] : null;
	}

	/**
	* check key already exists in session array
	*
	* @param string $key
	* @return bool 
	*/
	function has(string $key): bool
	{
		return isset($_SESSION[$key]);
	}

	/**
	* get all values in session array
	*
	* @return mixed
	*/
	function all()
	{
		return $_SESSION;
	}

	/**
	* remove value from session array by key
	* 
	* @param string $key
	* @return void
	*/
	function remove(string $key): void
	{
		unset($_SESSION[$key]) ;
	}

	/**
	* empty session array and destroy session 
	*
	* @return void
	*/
	function destroy(): void
	{
		$_SESSION = array();
    	if (ini_get("session.use_cookies")) {
        	$params = session_get_cookie_params();
        	setcookie(session_name(), '', time() - 420000, $params['path'], $params['domain'], $params['secure'], $params['httponly']);
    	}
    	session_destroy();	
	}

	/**
	* remove value from session array and return the value 
	*
	* @param string $key
	* @return mixed
	*/
	function flash(string $key)
	{
		$value = $this->get($key);
		$this->remove($key);
		return $value;
	}
}
?>