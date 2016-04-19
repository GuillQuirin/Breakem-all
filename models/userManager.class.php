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
		parent::save();	
	}

	public function tokenConnect(user $user){
		$sql = "SELECT * FROM ".$this->table." WHERE email='".$user->getEmail()."' AND token='".$user->getToken()."'";
		$query = $this->pdo->query($sql)->fetch();

		if(!is_array($query))
			return false;

		return new user($query);
	}

	public function userMailExists(user $user){
		$sql = "SELECT COUNT(*) FROM ".$this->table." WHERE email='".$user->getEmail()."'";
		$query = (bool) $this->pdo->query($sql)->fetch();
		return $query;
	}


	public function tryConnect(user $user){
		$sql = "SELECT * FROM ".$this->table." WHERE email='".$user->getEmail()."'";
		$query = $this->pdo->query($sql)->fetch();

		if(!is_array($query))
			return false;

		$dbUser = new user($query);
		if(password_verify($user->getPassword(), $dbUser->getPassword())){
			// définition du token
			$token = md5($dbUser->getId().$dbUser->getName().$dbUser->getEmail().SALT.date('Ymd'));
			$query['token'] = $token;
			// print_r($query);
			$dbUser = new user($query);
			$this->changeToken($dbUser);
			return $dbUser;
		}
		return false;
	}
	private function changeToken(user $user){
		$sql = "UPDATE ".$this->table." SET token='".$user->getToken()."' WHERE id=".$user->getId();
		$query = $this->pdo->query($sql);
	}
}
