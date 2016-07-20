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
		$sql = "SELECT u.id, u.name, u.firstname, u.pseudo, u.birthday, u.description, u.kind, u.city, u.email, u.password, u.status, u.img, u.idTeam, u.isConnected, u.lastConnexion, u.rss, u.authorize_mail_contact, u.token, t.name AS nameTeam, SUM(mp.points) as totalPoints
				FROM user u
				LEFT OUTER JOIN rightsteam rt ON rt.idUser = u.id
				LEFT OUTER JOIN team t ON rt.idTeam = t.id";
		$sql .= " LEFT OUTER JOIN register r ";
		$sql .= " ON r.idUser = u.id ";
		$sql .= " LEFT OUTER JOIN matchparticipants mp ";
		$sql .= " ON r.idTeamTournament = mp.idTeamTournament ";
		$sql .= "WHERE u.email =  :email";
		$sth = $this->pdo->prepare($sql, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
		$sth->execute([
			':email' => $user->getEmail()
		]);
		$r = $sth->fetchAll(PDO::FETCH_ASSOC);
		// $r est toujours un array qui stock chaque ligne récupérée dans un sous array
		// ce qui nous interesse est donc de savoir si le $r[0] existe

		if(isset($r[0])){
			if(count(array_filter($r[0])) === 0)
				return -2;
			//Membre non-banni
			if((int)$r[0]['status'] > 0){
				$dbUser = new user($r[0]);
				if(ourOwnPassVerify($user->getPassword(), $dbUser->getPassword()))
					return $dbUser;
			}
			else if((int)$r[0]['status'] == 0)
				return 0;
			else
				return -1;
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
		$sql = "SELECT u.id, u.name, u.firstname, u.pseudo, u.birthday, u.description, u.kind, u.city, u.email, u.password, u.status, u.img, u.idTeam, u.isConnected, u.lastConnexion, u.rss, u.authorize_mail_contact, u.token, t.name AS nameTeam, SUM(mp.points) as totalPoints
				FROM user u
				LEFT OUTER JOIN rightsteam rt ON rt.idUser = u.id
				LEFT OUTER JOIN team t ON rt.idTeam = t.id";
		$sql .= " LEFT OUTER JOIN register r ";
		$sql .= " ON r.idUser = u.id ";
		$sql .= " LEFT OUTER JOIN matchparticipants mp ";
		$sql .= " ON r.idTeamTournament = mp.idTeamTournament ";
		$sql .= " WHERE u.email =  :email AND u.status > 0";


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

	/* GET ID */
	// C EST DLA MERDE CETTE FONCTION, ON PASSE JAMAIS AU GRAND JAMAIS PAR * EN SQL, TEDDYNOOOB VIRE MOI CETTE FONCTION !!!
	public function getIdUser($id){
		$sql = "SELECT * FROM " .$this->table . " WHERE id=:id";

		$sth = $this->pdo->prepare($sql, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
		$sth->execute([ ':id' => $id ]);
		$r = $sth->fetchAll(PDO::FETCH_ASSOC);
		
		return new user($r[0]);
	}

	/*MODIFICATION TEAM DU USER*/
	public function setNewTeam(user $u, team $t=NULL){
		$sql = "UPDATE ".$this->table." SET idTeam = :idTeam WHERE id=:id;";
		$sth = $this->pdo->prepare($sql, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
		$sth->execute([
			':id' => $u->getId(),
			':idTeam' => (($t)?$t->getId():NULL)
		]);
	}

	/*Modification tous les users d'une team : dissoudre la team*/
	public function setAllUser(team $t=NULL){
		$sql = "UPDATE user SET idTeam = NULL WHERE idTeam = :idTeam;";
		$sth = $this->pdo->prepare($sql, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
		$sth->execute([
			':idTeam' => (($t)?$t->getId():NULL)
		]);
	}

	/*MODIFICATION USER*/
	public function setUser(user $u, user $newuser){
		$data = [];

		foreach (get_class_methods($newuser) as $key => $method_name) {
			if(is_numeric(strpos($method_name, "get"))){
				$prop = strtolower(str_replace("get","",$method_name));
				$data[$prop] = ($prop==="img") ? $newuser->$method_name(true) : $newuser->$method_name(); 
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

		$sql = "SELECT u.id, u.name, u.firstname, u.pseudo, u.birthday, 
						u.description, u.kind, u.city, u.email, u.password, u.status, 
						u.img, u.idTeam, u.isConnected, u.lastConnexion,
						u.rss, u.authorize_mail_contact, u.token, t.name as nameTeam, SUM(mp.points) as totalPoints
					FROM ".$this->table." u
					LEFT OUTER JOIN team t ON u.idTeam = t.id";
		$sql .= " LEFT OUTER JOIN register r ";
		$sql .= " ON r.idUser = u.id ";
		$sql .= " LEFT OUTER JOIN matchparticipants mp ";
		$sql .= " ON r.idTeamTournament = mp.idTeamTournament ";
		$sql .= "WHERE u.status<>0 AND " . implode(',', $data);

		$query = $this->pdo->query($sql)->fetch();
		if($query === FALSE)
			return false;

		return new user($query);
	}

	/*SUPPRESSION DU COMPTE*/
	public function deleteAccount(user $u){

		$sql = "UPDATE ".$this->table." 
				SET status=-1, pseudo='-1', birthday='-1', description=NULL, email='-1', img = NULL, isConnected=0  
				WHERE id=:id 
					AND pseudo=:pseudo 
					AND password=:password";

		$query = $this->pdo->prepare($sql, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));

		//variables obligatoires
		$id=$u->getId();
		$pseudo=$u->getPseudo();
		$password=$u->getPassword();

		$query->bindParam(':id', $id, PDO::PARAM_INT);
		$query->bindParam(':pseudo', $pseudo, PDO::PARAM_INT);
		$query->bindParam(':password', $password, PDO::PARAM_INT);
		$query->execute();
	}


	/*RECUPERATION DE TOUS LES USER*/
	//Public
	public function getAllUser(){
		
		$sql = "SELECT u.id, u.name, u.firstname, u.pseudo, u.birthday, 
						u.description, u.kind, u.city, u.email, u.password, u.status, 
						u.img, u.idTeam, u.isConnected, u.lastConnexion,
						u.rss, u.authorize_mail_contact, u.token, t.name as nameTeam, SUM(mp.points) as totalPoints
					FROM ".$this->table." u
					LEFT OUTER JOIN team t ON u.idTeam = t.id";
		$sql .= " LEFT OUTER JOIN register r ";
		$sql .= " ON r.idUser = u.id ";
		$sql .= " LEFT OUTER JOIN matchparticipants mp ";
		$sql .= " ON r.idTeamTournament = mp.idTeamTournament ";
		$sql .= "WHERE u.status>0
						GROUP BY u.id";

		$req = $this->pdo->prepare($sql, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
		$req->execute();

		while ($query = $req->fetch(PDO::FETCH_ASSOC))
			//tableau d'objets user
			$list[] = new user($query);

		return (count($list) > 0) ? $list : false;
	}

	//Administration
	public function getAdminListUser(){
		$sql="SELECT user.id, user.name, user.firstname, user.pseudo, user.password,
						user.birthday, user.description, user.kind, user.city, 
						user.email, user.status, user.authorize_mail_contact,
						user.img, user.idTeam, user.isConnected, user.lastConnexion,
						COUNT(id_signaled_user) as reportNumber, SUM(mp.points) as totalPoints
					FROM user 
					LEFT JOIN signalmentsuser 
							ON user.id = signalmentsuser.id_signaled_user";
		$sql .= " LEFT OUTER JOIN register r ";
		$sql .= " ON r.idUser = user.id ";
		$sql .= " LEFT OUTER JOIN matchparticipants mp ";
		$sql .= " ON r.idTeamTournament = mp.idTeamTournament ";
		$sql .= " GROUP BY user.id";

		$req = $this->pdo->prepare($sql, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
		$req->execute();
		$list = [];
		while ($query = $req->fetch(PDO::FETCH_ASSOC))
			//tableau d'objets user
			$list[] = new user($query);

		return $list;
	}	


	/*MODIFICATION DE LA TEAM */
	public function setNewTeamId($u, $t){
		$sql = "UPDATE user SET idTeam = :idTeam WHERE id = :id";
		$sth = $this->pdo->prepare($sql, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
		$sth->execute([
			':idTeam' => $t,
			':id' => $u
		]);
	}

	public function userByPseudo(user $u){
		$sql = "SELECT pseudo FROM " .$this->table . " WHERE pseudo=:pseudo";
		$sth = $this->pdo->prepare($sql, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
		$sth->execute([ ':pseudo' => $u->getPseudo()]);
		$r = $sth->fetchAll(PDO::FETCH_ASSOC);
	
		return $r[0];
	}
}