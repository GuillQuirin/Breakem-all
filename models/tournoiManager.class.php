<?php
final class tournoiManager extends sqlManager{

	public function __construct(){
		parent::__construct();
	}

	public function create(tournoi $tournoi){
		// Check afin de savoir qui appelle cette méthode
		$e = new Exception();
		$trace = $e->getTrace();

		// get calling class:
		$calling_class = (isset($trace[1]['class'])) ? $trace[1]['class'] : false;
		// get calling method
		$calling_method = (isset($trace[1]['function'])) ? $trace[1]['function'] : false;


		if(!$calling_class || !$calling_method)
			die("Tentative d'enregistrement depuis une autre methode que verifyAction de la classe InscriptionController!");

		// Si appelée depuis la page inscription
		if ($calling_class === "tournoiController" && $calling_method === "verifyAction"){
			$this->columns = [];
			$user_methods = get_class_methods($user);

			foreach ($user_methods as $key => $method) {
				if(strpos($method, 'get') !== FALSE){
					$col = lcfirst(str_replace('get', '', $method));
					$this->columns[$col] = $user->$method();
				};
			}
			$this->columns = array_filter($this->columns);
			$this->save();
		}
	}

	public function save(){
		parent::save();	
	}


}

