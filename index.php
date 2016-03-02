<?php
require_once "conf.inc.php";

<<<<<<< HEAD
<p> Vous êtes bien sur le site Break'em allllll </p>
<?php
	include "vue/template/footer.php";
=======
// Reloader automatique
//		appelé à chaque fois que php ne trouve pas une classe
function mon_loader($class){
	if( file_exists("core/".$class.".class.php")){
		require_once("core/".$class.".class.php");
	}
	if( file_exists("models/".$class.".class.php")){
		require_once("models/".$class.".class.php");
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
	$name_action = $route["c"]."Action";
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






	
>>>>>>> ad06ad88bb4d1f313bae4a091eb755a647945300
?>