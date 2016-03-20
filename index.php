<?php
require_once "conf.inc.php";

// Reloader automatique
//<<<<<<< HEAD
//		appelé à chaque fois que php ne trouve pas une classe
//=======
//>>>>>>> master
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

// var_dump(['name_page' => $name_page], ['name_controller' => $name_controller], ['path_controller' => $path_controller]);
if(file_exists($path_controller)){
	require_once($path_controller);
	$controller = new $name_controller;
	$name_action = $route["a"]."Action";
	// var_dump($name_action);
	if(method_exists($controller, $name_action)){
		$controller->$name_action($route["args"]);
	}	
	else{
		die("404, l'action n'existe pas");
	}
}else{
	die("404, controller inexistant!");
}

?>
