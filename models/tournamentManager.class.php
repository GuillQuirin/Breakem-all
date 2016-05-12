<?php
/*
*
*/
final class tournamentManager extends basesql{

	public function create(tournament $tournoi){
		// Check afin de savoir qui appelle cette méthode
		$e = new Exception();
		$trace = $e->getTrace();

		// get calling class:
		$calling_class = (isset($trace[1]['class'])) ? $trace[1]['class'] : false;
		// get calling method
		$calling_method = (isset($trace[1]['function'])) ? $trace[1]['function'] : false;


		if(!$calling_class || !$calling_method)
			die("Tentatrbebrvrevtreezzment depuis une autre methode que finalValidationActervreverviezon de la classe TournoiController!");

		// Si appelée depuis la page tournoi
		if ($calling_class === "creationtournoiController" && $calling_method === "finalValidationAction"){
			$this->columns = [];
			$tournoiMeths = get_class_methods($tournoi);

			foreach ($tournoiMeths as $key => $method) {
				if(strpos($method, 'get') !== FALSE){
					$col = lcfirst(str_replace('get', '', $method));
					$this->columns[$col] = $tournoi->$method();
				};
			}
			// Toutes les propriétés à 0 sont remove de l'array à ce moment là
			// Pas impactant ici puisque les default value dans tournoi sont à 0
			$this->columns = array_filter($this->columns);
			// print_r($this->columns);
			$this->save();
		}else{
			die("Tentative d'enregistrement depuis une autre methode que finalValidationAction de la classe TournoiController!");
		}
	}

	public function save(){
		parent::save();	
	}

	public function getUnstartedTournaments(){
		$sql = "SELECT * FROM Tournament WHERE startDate > UNIX_TIMESTAMP(LOCALTIME())";
		$sth = $this->pdo->query($sql);
		$r = $sth->fetchAll();
		if(isset($r[0])){
			$alltournaments = [];
			foreach ($r as $key => $data) {
				$alltournaments[] = new tournament($data);
			}
			return $alltournaments;
		}
		return false;
	}

	public function getTournament(array $infos){
		
		$cols = array_keys($infos);
		$data = [];
		foreach ($cols as $key) {
			$data[$key] = $key.'="'.$infos[$key].'"';
		}
		$sql = "SELECT * FROM ".$this->table." WHERE " . implode(',', $data);
		// var_dump($sql);
		$query = $this->pdo->query($sql)->fetch();
		if($query === FALSE)
			return false;
		return new user(array_filter($query));
	}

	public function getFilteredTournaments($searchArray){
		$sql = "SELECT t.id, t.startDate, t.endDate, t.description, t.typeTournament, t.status, t.nbMatch, t.idUserCreator, t.idGameVersion, t.idWinningTeam, t.urlProof, t.creationDate, t.guildOnly, t.randomPlayerMix, t.name, gv.maxPlayer, gv.maxTeam, gv.maxPlayerPerTeam, gv.name as gvName, gv.description as gvDescription, ga.id as gameId, ga.name as gameName, ga.description as gameDescription, ga.img as gameImg, ga.year as gameYear, ga.idType as gtId, p.id as pId, p.name as pName, p.description as pDescription, p.img as pImg FROM tournament t ";		
		// On est obligé de rajouter les % sur les values des array
		// 	les mettre dans la requete ne fonctionnant apparemment pas
		$sql .= " LEFT OUTER JOIN gameversion gv ON t.idgameVersion = gv.id";
		$sql .= " LEFT OUTER JOIN game ga ON ga.id = gv.idGame";
		$sql .= " LEFT OUTER JOIN platform p ON p.id = gv.idPlateform";
		$sql .= " WHERE t.startDate > UNIX_TIMESTAMP(LOCALTIME())";

		$data = [];
		if(isset($searchArray['nom'])){
			$sql .= " AND t.name LIKE :nom";
			$data[':nom'] = '%'.$searchArray['nom'].'%';
		}
		if(isset($searchArray['jeu'])){
			$sql .= " AND ga.name LIKE :jeu";
			$data[':jeu'] = '%'.$searchArray['jeu'].'%';
		}
		if(isset($searchArray['console'])){
			$sql .= " AND p.name LIKE :console ";
			$data[':console'] = '%'.$searchArray['console'].'%';
		}
		// echo $sql;
		// var_dump($data);
		$sth = $this->pdo->prepare($sql, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
		$sth->execute($data);
		$r = $sth->fetchAll();
		if(isset($r[0])){
			$alltournaments = [];
			foreach ($r as $key => $data) {
				$alltournaments[] = new tournament($data);
			}
			return $alltournaments;
		}
		return false;
	}
}
/*
*
*/

/*
SELECT t.id, t.startDate, t.endDate, t.description, t.typeTournament, t.status, t.nbMatch, t.idUserCreator, t.idGameVersion, t.idWinningTeam, t.urlProof, t.creationDate, t.guildOnly, t.randomPlayerMix, t.name, gv.maxPlayer, gv.maxTeam, gv.maxPlayerPerTeam, gv.name as gvName, gv.description as gvDescription, ga.id as gameId, ga.name as gameName, ga.description as gameDescription, ga.img as gameImg, ga.year as gameYear, ga.idType as gtId, p.id as pId, p.name as pName, p.description as pDescription, p.img as pImg FROM tournament t  
LEFT OUTER JOIN gameversion gv ON t.idgameVersion = gv.id 
LEFT OUTER JOIN game ga ON ga.id = gv.idGame 
LEFT OUTER JOIN platform p ON p.id = gv.idPlateform 
WHERE t.startDate > UNIX_TIMESTAMP(LOCALTIME()) 
AND ga.name LIKE :jeu
\G

 */