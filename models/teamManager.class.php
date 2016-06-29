<?php 

class teamManager extends basesql{
	public function __construct(){
		/*
			L'appel du constructeur de la classe-mère basesql va permettre
			de cibler uniquement la table correspondant 
			au nom du manager : ici sera la table Team
		*/
		parent::__construct();
	}

/*	
	public function create(team $team){	
	// Check afin de savoir qui appele cette méthode
		$e = new Exception();
		$trace = $e->getTrace();

		// get calling class:
		$calling_class = (isset($trace[1]['class'])) ? $trace[1]['class'] : false;
		// get calling method
		$calling_method = (isset($trace[1]['function'])) ? $trace[1]['function'] : false;


		if(!$calling_class || !$calling_method)
			header('Location: '.WEBPATH);

		// Si appelée depuis la page tournoi
		if ($calling_class === "creationtournoiController" 
				&& $calling_method === "finalValidationAction"){

			$this->columns = [];
			$team_methods = get_class_methods($team);

			foreach ($team_methods as $key => $method) {
				if(strpos($method, 'get') !== FALSE){
					$col = lcfirst(str_replace('get', '', $method));
					$this->columns[$col] = $team->$method();
				};
			}
			// Toutes les propriétés à 0 sont remove de l'array à ce moment là
			// Pas impactant ici puisque les default value dans tournoi sont à 0
			$this->columns = array_filter($this->columns);

			$this->save();

		}
		else
			header('Location: '.WEBPATH);		
	}*/
	
	/*AJOUT PRESIDENT TEAM*/
	public function setOwnerTeam(team $t, user $u){
		$sql = "INSERT INTO rightsteam (id, idUser, idTeam, right) 
				VALUES ('', ':idUser', ':idTeam', '1')";
		$sth = $this->pdo->prepare($sql, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
		$sth->execute([
			':idUser' => $u->getId(),
			':idTeam' => $t->getId()
		]);
		$r = $sth->fetchAll();

		return (bool) $r[0][0];
	}

	/*VERIFICATION DE L'UNICITE DU NOM TEAM*/
	public function isNameUsed(team $t){
		$sql = "SELECT COUNT(*) FROM team WHERE name=:name";
		$sth = $this->pdo->prepare($sql, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
		$sth->execute([
			':name' => $t->getName()
		]);
		$r = $sth->fetchAll();

		return (bool) $r[0][0];
	}

	/*RECUPERATION TEAM SELON NOM*/
	public function getTeamFromName(team $t){
		$sql = "SELECT * FROM team WHERE name=:name";
		$sth = $this->pdo->prepare($sql, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
		$sth->execute([
			':name' => $t->getName()
		]);
		$r = $sth->fetchAll();
		if(isset($r[0]))
			return new team($r[0]);
		return false;
	}
	
	//Liste des teams
	public function getListTeam($status){
		$sql="SELECT * FROM team WHERE status >'".$status."' ORDER BY name ASC";

		$req = $this->pdo->prepare($sql, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
		$req->execute();
		$list = [];
		while ($query = $req->fetch(PDO::FETCH_ASSOC))
			//tableau d'objets team
			$list[] = new team($query);
	
		return $list;
	}

	//Vérification du name en paramètre dans la bdd
	public function getNameTeam($nameTeam){
		$sql = "SELECT name FROM team WHERE name = '".$nameTeam."'";
		
		$req = $this->pdo->prepare($sql, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
		$req->execute();
		
		$res = $req->fetchAll();
		if(isset($res[0]))
			return true;
		return false;
	}



	//UPDATE LE STATUS DE LA TEAM DANS L'ADMIN
	public function changeStatusTeam(team $t){
		$sql = "UPDATE team SET status = :status WHERE id= :id";
		$req = $this->pdo->prepare($sql, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
		$req->execute([
			':status' => $t->getStatus(),
			':id' => $t->getId()
		]);
		$res = $req->fetchAll();
		if(isset($res[0]))
			return true;
		return false;
	}
	//UPDATE LE SLOGAN ET DESCRIPTION DE LA TEAM DANS L'ADMIN
	public function updateTeam(team $t){
		$sql = "UPDATE team SET slogan = :slogan, description = :description WHERE id= :id";
		$req = $this->pdo->prepare($sql, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
		$req->execute([
			':slogan' => $t->getSlogan(),
			':description' => $t->getDescription(),
			':id' => $t->getId()
		]);
		$res = $req->fetchAll();
		if(isset($res[0]))
			return true;
		return false;
	}
	/*MODIFICATION TEAM*/
	public function setTeam(team $u, team $newteam){
		$data = [];

		foreach (get_class_methods($newteam) as $key => $method_name) {
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

	/*RECUPERATION TEAM*/
	public function getTeam(array $infos){

		//tab[name]='Test'
		$cols = array_keys($infos);
		$data = [];
		$where = '';

		foreach ($cols as $key ){

			//On met la ligne de $infos dans le tableau $data
			$data[$key] = $infos[$key];

			//WHERE name = :name AND col2 = :col2 etc.....
			$where .= $key.'=:'.$key.'';

			//Tant qu'on est pas à la fin du tableau, on rajoute un AND à la requete SQL
			if(end($cols)!==$key)
				$where.= ' AND ';
		}

		$sql = "SELECT * FROM team WHERE ".$where;

		$query = $this->pdo->prepare($sql, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));	
		$query->execute($data);	
		
		//fetch -> retourne une ligne de la BDD
		//fetchAll -> retourne plusieurs de la BDD
		$r = $query->fetch(PDO::FETCH_ASSOC);

		if($query === FALSE)
			return false;

		return new team($r);
	}

	public function setIdTeam($id){

		$sql = "UPDATE user SET idTeam = :idTeam WHERE id =
    (SELECT id FROM Race WHERE nom = 'Berger Allemand'); ";
		$req = $this->pdo->prepare($sql, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
		$req->execute([
			':idTeam' => $id,

		]);
		$res = $req->fetchAll();
		if(isset($res[0]))
			return true;
		return false;
	}
}

/*$sql = "UPDATE team SET status = :status WHERE id= :id";
		$req = $this->pdo->prepare($sql, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
		$req->execute([
			':status' => $t->getStatus(),
			':id' => $t->getId()
		]);
		$res = $req->fetchAll();
		if(isset($res[0]))
			return true;
		return false;  id_user_creator*/