<?php
date_default_timezone_set('Europe/Paris');
setlocale(LC_TIME, 'fr_FR');

//Messages d'erreur pour debug
ini_set('display_errors', 1); 
error_reporting(E_ALL | E_STRICT);

require_once "conf.inc.php";
require_once "functions.php";

cleanTimedOutSession();
/*var_dump($_SERVER);
flush();
session_destroy();
exit;*/

// Reloader automatique
function mon_loader($class){
	if( file_exists("core/".$class.".class.php")){
		require_once("core/".$class.".class.php");
		return;
	}
	if( file_exists("models/".$class.".class.php")){
		require_once("models/".$class.".class.php");
		return;
	}
	if( file_exists("models/".$class."Manager.class.php")){
		require_once("models/".$class."Manager.class.php");
		return;
	}
}
spl_autoload_register('mon_loader');

$route = routing::setRouting();

$name_page = $route["c"];
$name_controller = $route["c"]."Controller";
$path_controller = "controllers/".$name_controller.".class.php";

$routeExists = false;
if(file_exists($path_controller)){
	require_once($path_controller);
	$controller = new $name_controller;
	$name_action = $route["a"]."Action";

	if(method_exists($controller, $name_action)){
		$controller->$name_action($route["args"]);
		$routeExists = true;
	}
}
if(!$routeExists){
	require_once("controllers/LoadFailController.class.php");
	new LoadFailController();
}

?>
