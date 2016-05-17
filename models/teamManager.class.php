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


	
	/*AJOUT PRESIDENT TEAM*/
	public function setOwnerTeam(team $t, $idUser){
		$sql = "INSERT INTO rightsteam (id, idUser, idTeam, right) 
				VALUES ('', '".$idUser."', '".$idTeam."', '1')";
		$query = $this->pdo->query($sql);
		
		return $query;
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

		$sql = "SELECT id, name, img, slogan, description, status 
					FROM team 
					WHERE ".$where;

		$query = $this->pdo->prepare($sql, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));	
		$query->execute($data);	
		
		//fetch -> retourne une ligne de la BDD
		//fetchAll -> retourne plusieurs de la BDD
		$r = $query->fetch(PDO::FETCH_ASSOC);

		if($query === FALSE)
			return false;

		return new team($r);
	}

	public function getTeamTest(array $infos){
		
		$cols = array_keys($infos);
		$data = [];
		foreach ($cols as $key) {
			$data[$key] = $key.'="'.$infos[$key].'"';
		}

		$sql = "SELECT id, name, img, slogan, description, status 
					FROM team
					WHERE ".implode(',', $data);

		$query = $this->pdo->query($sql)->fetch();

		if($query === FALSE)
			return false;

		return new team($query);
	}

}
