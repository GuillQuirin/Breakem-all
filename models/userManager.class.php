<?php 

class userManager extends basesql{
	public function __construct(){
		parent::__construct();
	}

	/*VERIFICATION EXISTENCE COMPTE*/
	public function userMailExists(user $user){
		$sql = "SELECT COUNT(*) FROM ".$this->table." WHERE email='".$user->getEmail()."'";
		$query = (bool) $this->pdo->query($sql)->fetch();
		return $query;
	}

	/*VERIFICATION VALIDITE IDENTIFIANTS DE CONNEXION*/
	public function tryConnect(user $user){
		$sql = "SELECT * FROM ".$this->table." WHERE email=:email AND status>0";
		$sth = $this->pdo->prepare($sql, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
		$sth->execute([
			':email' => $user->getEmail()
		]);
		$r = $sth->fetchAll();
		// $r est toujours un array qui stock chaque ligne récupérée dans un sous array
		// ce qui nous interesse est donc de savoir si le $r[0] existe

		if(isset($r[0])){
			$dbUser = new user($r[0]);
			if(ourOwnPassVerify($user->getPassword(), $dbUser->getPassword()))
				return $dbUser;
		}
		return false;
	}

	/*VERIFICATION PARAMETRES D'ACTIVATION COMPTE*/
	public function checkMailToken(user $user){		
		$sql = "SELECT COUNT(*) as nb FROM ".$this->table." WHERE token=:token AND email=:email AND status=0";
		$sth = $this->pdo->prepare($sql, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
		$sth->execute([
			':token' => $user->getToken(),
			':email' => $user->getEmail()
		]);
		$r = $sth->fetchAll(PDO::FETCH_ASSOC);
		if( (bool) $r[0]['nb'] ){
			if ($this->activateAccount($user))		
				return true;
		}
		return false;
	}

	/*ACTIVATION NOUVEAU COMPTE*/
	private function activateAccount(user $u){
		$sql = "UPDATE ".$this->table." SET status = 1, token = '' WHERE email=:email AND status=0";
		$sth = $this->pdo->prepare($sql, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
		$r = $sth->execute([
			':email' => $u->getEmail()
		]);
		return $r;
	}

	/*MODIFIER MOT DE PASSE*/
	public function recoverAccount(user $u, $password){
		$sql = "UPDATE ".$this->table." SET password = :password, token = '' WHERE email=:email ";
		$sth = $this->pdo->prepare($sql, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
		$r = $sth->execute([
			':email' => $u->getEmail(),
			':password' => $password
		]);
		
		return $r;
	}

	/*OUVERTURE A CHAQUE CONNEXION*/
	public function validTokenConnect(user $user){
		/*C'est ici que l'on set le isConnected à 1 (true)
		--> cette methode est appelée à chaque rechargement de page.
		--> mais aussi après une connection sans token (puisque un reload de page est déclenché apres la connexion par email/pass)
		*/
		$sql = "SELECT * FROM ".$this->table." WHERE email=:email AND status>0";
		$sth = $this->pdo->prepare($sql, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
		$sth->execute([
			':email' => $_SESSION[COOKIE_EMAIL]
		]);
		$r = $sth->fetchAll();
		// $r est toujours un array qui stock chaque ligne récupérée dans un sous array
		// ce qui nous interesse est donc de savoir si le $r[0] existe

		if(isset($r[0])){
			$sql = "UPDATE ".$this->table." SET isConnected=1, lastConnexion=:lastConnexion WHERE email=:email";
			$sth = $this->pdo->prepare($sql, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
			$sth->execute([
				':lastConnexion' => $user->getLastConnexion(),
				':email' => $user->getEmail()
			]);
			return new user($r[0]);
		}
		return false;
	}

	/*DECONNEXION*/
	public function disconnecting(user $user){
		$sql = "UPDATE ".$this->table." SET isConnected=0, lastConnexion=:lastConnexion WHERE email=:email";
		$sth = $this->pdo->prepare($sql, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
		$sth->execute([
			':lastConnexion' => $user->getLastConnexion(),
			':email' => $user->getEmail()
		]);
		$r = $sth->fetchAll();
	}

	/*MODIFICATION TEAM DU USER*/
	public function setNewTeam(user $u, team $t){
		$sql = "UPDATE ".$this->table." SET idTeam = :idTeam WHERE id=:id;";
		$sth = $this->pdo->prepare($sql, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
		$sth->execute([
			':id' => $u->getId(),
			':idTeam' => $t->getId()
		]);
	}

	/*MODIFICATION USER*/
	public function setUser(user $u, user $newuser){
		$data = [];

		foreach (get_class_methods($newuser) as $key => $method_name) {
			if(is_numeric(strpos($method_name, "get"))){
				$prop = strtolower(str_replace("get","",$method_name));
				$data[$prop] = $newuser->$method_name(); 
			}
		}

		$data = array_filter($data);

		$compteur=0;

		$sql = "UPDATE ".$this->table." SET ";
			foreach ($data as $key => $value) {
				if($compteur!=0) 
					$sql.=", ";
				$sql.=" ".$key."=:".$key."";
				$compteur++;
			}
		$sql.=" WHERE id=:id";

		$query = $this->pdo->prepare($sql, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));

		//ATTENTION: on précise la référence de $value avec &
		foreach ($data as $key => &$value)
			$query->bindParam(':'.$key, $value);
	
		$id = $u->getId();
		$query->bindParam(':id', $id, PDO::PARAM_INT);
		$query->execute();
	}

	/*RECUPERATION INFOS USER*/
	public function getUser(array $infos){
		
		$cols = array_keys($infos);
		$data = [];
		foreach ($cols as $key) {
			$data[$key] = $key.'="'.$infos[$key].'"';
		}

		$sql = "SELECT id, name, firstname, pseudo, birthday, 
						description, kind, city, email, status, 
						img, idTeam, isConnected, lastConnexion,
						rss, authorize_mail_contact, token 
					FROM ".$this->table." 
					WHERE status<>0 AND " . implode(',', $data);

		$query = $this->pdo->query($sql)->fetch();

		if($query === FALSE)
			return false;

		return new user($query);
	}
}