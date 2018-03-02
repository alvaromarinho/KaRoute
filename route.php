<?php

require_once 'vendor/KaRoute.php';

// error_reporting(E_ALL);
// ini_set("display_errors", 1);

$request = str_replace("/fascia", "", $_SERVER['REQUEST_URI']);
KaRoute::setRequest($request);

KaRoute::get('/', 	 'index');
KaRoute::get('test', 'index', 
	function($args){ echo "<script>alert('Function performed before!')</script>"; },
	function($args){ echo "<script>alert('Function performed after!')</script>"; }
);
