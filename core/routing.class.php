<?php

class routing{
	public static function setRouting(){
		$uri = $_SERVER['REQUEST_URI'];
		$explode_uri = explode("?",$uri);
		$uri = $explode_uri[0];
		$uri = trim(str_replace("esgi2/","",$uri),"/");
		$explode_uri = explode("/",$uri);
		//print_r($explode_uri);
		$c = (!empty($explode_uri[0]))?$explode_uri[0]:"index";
		$a = (!empty($explode_uri[1]))?$explode_uri[1]:"index";

		unset($explode_uri[0]);
		unset($explode_uri[1]);

		$args = array_merge($explode_uri, $_REQUEST);

		return ["c" => $c, "a"=> $a, "args" =>$args];

		//echo $uri;
	}
}
