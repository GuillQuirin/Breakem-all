<?php 

class userManager extends basesql{
	public function __construct(){
		parent::__construct();
	}

	
	public function create(user $user){
		// Check afin de savoir qui appelle cette méthode
		$e = new Exception();
		$trace = $e->getTrace();

		// get calling class:
		$calling_class = (isset($trace[1]['class'])) ? $trace[1]['class'] : false;
		// get calling method
		$calling_method = (isset($trace[1]['function'])) ? $trace[1]['function'] : false;


		if(!$calling_class || !$calling_method)
			die("Pas de methode appelée pour l'inscription !");

		// Si appelée depuis la page acceuil
		if ($calling_class === "template" && $calling_method === "registerAction"){
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
		else
			die("Tentative d'enregistrement depuis une autre methode que registerAction de la classe IndexController!");
	}

	public function userMailExists(user $user){
		$sql = "SELECT COUNT(*) FROM ".$this->table." WHERE email='".$user->getEmail()."'";
		$query = (bool) $this->pdo->query($sql)->fetch();
		return $query;
	}

	public function tryConnect(user $user){
		$sql = "SELECT * FROM ".$this->table." WHERE email=:email AND status=1";
		$sth = $this->pdo->prepare($sql, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
		$sth->execute([
			':email' => $user->getEmail()
		]);
		$r = $sth->fetchAll();
		// $r est toujours un array qui stock chaque ligne récupérée dans un sous array
		// ce qui nous interesse est donc de savoir si le $r[0] existe

		if(isset($r[0])){
			$dbUser = new user($r[0]);
			// print_r($dbUser);
			// exit;
			if(password_verify($user->getPassword(), $dbUser->getPassword())){
				return $dbUser;
			}
				
		}
		return false;
	}

	public function checkMailToken(user $user){		
		$sql = "SELECT COUNT(*) as nb FROM ".$this->table." WHERE token=:token AND email=:email AND status=0";
		$sth = $this->pdo->prepare($sql, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
		$sth->execute([
			':token' => $user->getToken(),
			':email' => $user->getEmail()
		]);
		$r = $sth->fetchAll(PDO::FETCH_ASSOC);
		if( (bool) $r[0]['nb'] ){
			$this->activateAccount($user);
			return true;
		}
		return false;
	}

	private function activateAccount(user $u){
		$sql = "UPDATE ".$this->table." SET status=1, token=NULL WHERE email=:email AND  token=:token";
		$sth = $this->pdo->prepare($sql, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
		$sth->execute([
			':token' => $u->getToken(),
			':email' => $u->getEmail()
		]);
	}

	/*C'est ici que l'on set le isConnected à 1 (true)
		--> cette methode est appelée à chaque rechargement de page.
		--> mais aussi après une connection sans token (puisque un reload de page est déclenché apres la connexion par email/pass)
	*/
	public function validTokenConnect(user $user){
		$sql = "SELECT * FROM ".$this->table." WHERE email=:email AND status=1";
		$sth = $this->pdo->prepare($sql, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
		$sth->execute([
			':email' => $_SESSION[COOKIE_EMAIL]
		]);
		$r = $sth->fetchAll();
		// $r est toujorus un array qui stock chaque ligne récupérée dans un sous array
		// ce qui nous interesse est donc de savoir si le $r[0] existe

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
	}

	public function setNewTeam(user $u, team $t){
		$sql = "UPDATE user SET idTeam = :idTeam WHERE id=:id;";
		$sth = $this->pdo->prepare($sql, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
		$sth->execute([
			':id' => $u->getId(),
			':idTeam' => $t->getId()
		]);
	}
}