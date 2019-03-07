<?php

namespace App\Core;

class Request

{

	public static function uri()
	
	{
		
		$uri = implode('/',
        array_slice(
            explode('/', $_SERVER['REQUEST_URI']), 1));

		return urldecode($uri);
		 //processInput($_SERVER['REQUEST_URI']);

		 //return trim(parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH), '/');

	}

	
	public static function method()

	{

		return $_SERVER['REQUEST_METHOD'];


	}
	


}