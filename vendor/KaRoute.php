<?php

class KaRoute {

	private static $request;

	public static function getRequest()
	{
		return self::$request;
	}

	public static function setRequest($request)
	{
		self::$request = $request;
	}

	public static function get($route, $file = null, $before = null, $after = null)
	{
		$_uri 	 = trim(self::getRequest(), "/");
		$_uri 	 = explode("/", $_uri);
		$_uri[0] = strstr($_uri[0], 'index') ? '' : $_uri[0];

			
		if($_uri[0] == trim($route, "/")){
			array_shift($_uri);

			/* PARAMETERS */
			if(strstr($_uri[0], '&')) {
				$_array_args = explode("&", $_uri[0]);
				if(strstr($_uri[0], '='))
					foreach ($_array_args as $parameter) {
						$values = explode("=", $parameter);
						$args[reset($values)] = end($values);
					}
				else 
					$args = $_array_args;
			} else if(strstr($_uri[0], '=')){
				$values = explode("=", $_uri[0]);
				$args[reset($values)] = end($values);
			} else
				$args = $_uri;
			/* PARAMETERS */

			if(is_callable($before)) 
				$before($args);
			if($file)
				require $file.'.php';
			if(is_callable($after)) 
				$after($args);
		}
		
	}

}