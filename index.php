<?php
    error_reporting(E_ALL);
    ini_set('display_errors', 1);
    
	//demarre la session 
	session_start();
	
	require_once("Config.php");
	
	require_once("Loader.php");
	
	$loader = new Loader();

	$router = new Router();

	$router->go();