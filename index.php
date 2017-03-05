<?php

	//demarre la session 
	session_start();
	
	require_once("Config.php");
	
	require_once("Loader.php");
	
	$loader = new Loader();

	$router = new Router();

	$router->go();