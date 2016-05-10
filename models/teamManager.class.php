<?php 

class teamManager extends basesql{
	public function __construct(){
		/*
			L'appel du constructeur de la classe-mère basesql va permettre
			de cibler uniquement la table correspondant au nom du manager : ici sera la table Team
		*/
		parent::__construct();
	}

	
	public function create(team $team){		
		$this->columns = [];
		$team_methods = get_class_methods($team);

		foreach ($team_methods as $key => $method) {
			if(is_numeric(strpos($method, 'get'))){
				$col = lcfirst(str_replace('get', '', $method));
				$this->columns[$col] = $team->$method();
			};
		}
		$this->columns = array_filter($this->columns);
		$r = $this->save();		
	}
	
	public function setOwnerTeam(team $t, $idUser){
		$sql = "INSERT INTO RightsTeam (id, idUser, idTeam, right) VALUES ('', '".$idUser."', '".$idTeam."', '1')";
		$query = $this->pdo->query($sql);
		return $query;
	}

	public function isNameUsed(team $t){
		$sql = "SELECT COUNT(*) FROM Team WHERE name=:name";
		$sth = $this->pdo->prepare($sql, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
		$sth->execute([
			':name' => $t->getName()
		]);
		$r = $sth->fetchAll();

		return (bool) $r[0][0];
	}

	public function getTeamFromName(team $t){
		$sql = "SELECT * FROM Team WHERE name=:name";
		$sth = $this->pdo->prepare($sql, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
		$sth->execute([
			':name' => $t->getName()
		]);
		$r = $sth->fetchAll();
		if(isset($r[0]))
			return new team($r[0]);
		return false;
	}
}
