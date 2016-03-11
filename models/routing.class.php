<?php

	class routing{

		public static function setRouting(){
			$uri = trim($_SERVER['REQUEST_URI'], "/");
			// var_dump($uri);
			$exploded_uri = explode("?", $uri);
			// var_dump($exploded_uri);

			$uri = $exploded_uri[0];			
			// echo "(string) url avant str_replace : ";
			// var_dump($uri);

			$uri = trim(str_replace("3ADW/ProjAnnuel-Breakemall", " ", $uri));
			// echo "(string) url apres str_replace() et trim(): ";
			// var_dump($uri);

			$exploded_uri = explode(".", $uri);

			$exploded_uri[0] = str_replace("/", "", $exploded_uri[0]);

			$c = (strlen($exploded_uri[0]) != 0)?$exploded_uri[0]:"index";
			$a = (isset($exploded_uri[1]))?$exploded_uri[1]:"index";

			unset($exploded_uri[0], $exploded_uri[1]);
			$args = array_merge($exploded_uri, $_REQUEST);

			// var_dump($_SERVER['REQUEST_URI']);

			return ["c" => $c, "a" => $a, "args" => $args];
		}
	}
		
?>