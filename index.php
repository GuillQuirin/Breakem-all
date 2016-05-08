<?php
session_start();
date_default_timezone_set('Europe/Paris');
/*flush();
session_destroy();
exit;*/
require_once "conf.inc.php";
require_once "functions.php";

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


if(file_exists($path_controller)){
	require_once($path_controller);
	$controller = new $name_controller;
	$name_action = $route["a"]."Action";

	if(method_exists($controller, $name_action)){
		$controller->$name_action($route["args"]);
	}	//LoadFailController
	else{
		require_once("controllers/LoadFailController.class.php");
		new LoadFailController();
	}

}else{
	require_once("controllers/LoadFailController.class.php");
	new LoadFailController();
}

?>
