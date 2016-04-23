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

	public function userMailExists(user $user){
		$sql = "SELECT COUNT(*) FROM ".$this->table." WHERE email='".$user->getEmail()."'";
		$query = (bool) $this->pdo->query($sql)->fetch();
		return $query;
	}

	public function tryConnect(user $user){
		$sql = "SELECT * FROM ".$this->table." WHERE email=:email";
		$sth = $this->pdo->prepare($sql, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
		$sth->execute([
			':email' => $user->getEmail()
		]);
		$r = $sth->fetchAll();
		// $r est toujorus un array qui stock chaque ligne récupérée dans un sous array
		// ce qui nous interesse est donc de savoir si le $r[0] existe
		// var_dump($r);
		// exit;
		if(isset($r[0])){
			$dbUser = new user($r[0]);
			if(password_verify($user->getPassword(), $dbUser->getPassword())){
				return $dbUser;
			}
				
		}
		return false;
	}

	/*C'est ici que l'on set le isConnected à 1 (true)
		--> cette methode est appelée à chaque rechargement de page.
		--> mais aussi après une connection sans token (puisque un reload de page est déclenché apres la connexion par email/pass)
	*/
	public function validTokenConnect(user $user){
		$sql = "SELECT * FROM ".$this->table." WHERE email=:email";
		$sth = $this->pdo->prepare($sql, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
		$sth->execute([
			':email' => $_SESSION[COOKIE_EMAIL]
		]);
		$r = $sth->fetchAll();
		// $r est toujorus un array qui stock chaque ligne récupérée dans un sous array
		// ce qui nous interesse est donc de savoir si le $r[0] existe
		// var_dump($r);
		// exit;
		if(isset($r[0])){
			$sql = "UPDATE ".$this->table." SET isConnected=1, lastConnexion=:lastConnexion WHERE email=:email";
			$sth = $this->pdo->prepare($sql, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
			$sth->execute([
				':lastConnexion' => $user->getLastConnection(),
				':email' => $user->getEmail()
			]);
			return new user($r[0]);
		}
		return false;
	}

	public function disconnecting(user $user){
		$sql = "UPDATE ".$this->table." SET isConnected=0, lastConnexion=:lastConnexion WHERE email=:email";
		$sth = $this->pdo->prepare($sql, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
		$sth->execute([
			':lastConnexion' => $user->getLastConnection(),
			':email' => $user->getEmail()
		]);
		$r = $sth->fetchAll();
		// var_dump($r);
		// exit;
	}

	public function setNewTeam(user $u, team $t){
		$sql = "UPDATE ".$this->table." SET idTeam=:idTeam WHERE id=:id";
		$sth = $this->pdo->prepare($sql, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
		$sth->execute([
			':idTeam' => $t->getId(),
			':id' => $u->getId()
		]);
		$r = $sth->fetchAll();
	}
}
