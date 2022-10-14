<?php

    session_start();

    ini_set('display_errors', 1);
	ini_set('display_startup_errors', 1);
	error_reporting(E_ALL);
	
	require "Config/Autoload.php";
	require "Config/Config.php";

	use Config\Autoload as Autoload;
	use Config\Router 	as Router;
	use Config\Request 	as Request;
		
	Autoload::start();

	// session_start();	//Por teoria lo pasamos al principio // si hay problemas con guardar un objeto en sessions volverlo a dejar aca

	require_once(VIEWS_PATH."header.php");
    // require_once(VIEWS_PATH."nav.php"); // -> Se va a cada vistaa
	// require_once(VIEWS_PATH."dueno-perfil.php");
	// require_once(VIEWS_PATH."guardian-perfil.php");
	// require_once(VIEWS_PATH."login.php");
	Router::Route(new Request());
	require_once(VIEWS_PATH."footer.php");
?>