<?php 

class teamManager extends basesql{
	public function __construct(){
		parent::__construct();
	}

	
	public function create(team $team){
		// Check afin de savoir qui appelle cette méthode
		$e = new Exception();
		$trace = $e->getTrace();

		// get calling class:
		$calling_class = (isset($trace[1]['class'])) ? $trace[1]['class'] : false;

		// get calling method
		$calling_method = (isset($trace[1]['function'])) ? $trace[1]['function'] : false;

		if(!$calling_class || !$calling_method)
			return false;

		// Si appelée depuis la page team
		if ($calling_class === "teamController" && $calling_method === "verifyAction"){
			$this->columns = [];
			$team_methods = get_class_methods($team);

			foreach ($team_methods as $key => $method) {
				if(strpos($method, 'get') !== FALSE){
					$col = lcfirst(str_replace('get', '', $method));
					$this->columns[$col] = $team->$method();
				};
			}
			$this->columns = array_filter($this->columns);
			$r = $this->save();
			return $r;
		}
		return false;
	}

	public function save(){
		parent::save();	
	}

	public function setOwnerTeam(team $t, $idUser){
		$sql = "INSERT INTO RightsTeam (id, idUser, idTeam, right) VALUES ('', '".$idUser."', '".$idTeam."', '1')";
		$query = $this->pdo->query($sql);
		return $query;
	}

	public function isNameUsed(team $t){
		$sql = "SELECT COUNT(*) FROM Team WHERE name='".$t->getName()."'";
		return (bool) $this->pdo->query($sql)->fetch();
	}
}
