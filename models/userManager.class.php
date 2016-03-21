<?php 

class userManager extends basesql{
	public function __construct(){
		parent::__construct();
	}

	
	public function create(user $user){
		// Check afin de savoir qui appelle cette méthode
		$e = new Exception();
		$trace = $e->getTrace();
		// var_dump($trace);
		// get calling class:
		$calling_class = (isset($trace[1]['class'])) ? $trace[1]['class'] : false;
		// get calling method
		$calling_method = (isset($trace[1]['function'])) ? $trace[1]['function'] : false;
		// var_dump($calling_class, $calling_method);

		if(!$calling_class || !$calling_method)
			die("Tentative d'enregistrement depuis une autre methode que verifyAction de la classe InscriptionController!");

		// Si appelée depuis la page inscription
		if ($calling_class === "inscriptionController" && $calling_method === "verifyAction"){
			$this->columns = [];
			$user_methods = get_class_methods($user);
			// var_dump($user_methods);
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
		//Elle doit faire soit un INSERT ou UPDATE Quand il n'y a pas d'id on fait un INSERT
		if(isset($this->columns['id'])){
			// UPDATE
		}else{
			//INSERT
			$sql = "INSERT INTO ".$this->table." (".implode(",",array_keys($this->columns)).")
			VALUES (:".implode(",:", array_keys($this->columns)).")";
			$query = $this->pdo->prepare($sql);
			// var_dump($query);
			$query->execute($this->columns);
		}
	}

}