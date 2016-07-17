<?php
/*
*
*/
final class tournamentManager extends basesql{
	
	public function getListTournaments(){
		if((bool)$this->pdo->query('SELECT COUNT(*) FROM tournament')->fetchColumn() === false)
			return false;
		// Ce gros morceau de requete permet d'alimenter un tournoi des noms de sa console, son jeu et plein d'autres trucs super cool comme le nombre de joueurs/teams maximum 
		$sql = "SELECT DISTINCT(t.id), t.startDate, t.endDate, t.description, t.typeTournament, t.status, t.nbMatch, t.idUserCreator, t.idGameVersion, t.idWinningTeam, t.urlProof, t.creationDate, t.guildOnly, t.randomPlayerMix, t.name, t.link, 
		gv.maxPlayer, gv.maxTeam, gv.maxPlayerPerTeam, gv.name as gvName, gv.description as gvDescription, 
		ga.id as gameId, ga.name as gameName, ga.description as gameDescription, ga.img as gameImg, ga.year as gameYear, ga.idType as gtId, 
		p.id as pId, p.name as pName, p.description as pDescription, p.img as pImg, 
		u.pseudo as userPseudo, 
		(SELECT COUNT(DISTINCT r.id) FROM register r WHERE r.idTournament = t.id) as numberRegistered
		FROM tournament t ";		
		// On est obligé de rajouter les % sur les values des array
		// 	les mettre dans la requete ne fonctionnant apparemment pas
		$sql .= " LEFT OUTER JOIN gameversion gv ON t.idgameVersion = gv.id";
		$sql .= " LEFT OUTER JOIN game ga ON ga.id = gv.idGame";
		$sql .= " LEFT OUTER JOIN platform p ON p.id = gv.idPlateform";
		$sql .= " LEFT OUTER JOIN user u ON u.id = t.idUserCreator";
		$sql .= " LEFT OUTER JOIN register r ON r.idTournament = t.id";
		
		$sql .= " GROUP BY t.id ORDER BY t.startDate";
		$sth = $this->pdo->query($sql);
		$r = $sth->fetchAll(PDO::FETCH_ASSOC);
		if(isset($r[0])){
			$alltournaments = [];
			$r[0] = array_filter($r[0]);
			if(is_array($r[0])){
				foreach ($r as $key => $data) {
					if(count(array_filter($data)) > 0){
						$alltournaments[] = new tournament($data);
					}
				}
			}			
			return (count($alltournaments) > 0) ? $alltournaments : false;
		}
		return false;
	}

	public function getRecentsTournaments($nb=20){
		if((bool)$this->pdo->query('SELECT COUNT(*) FROM tournament')->fetchColumn() === false)
			return false;
		// Ce gros morceau de requete permet d'alimenter un tournoi des noms de sa console, son jeu et plein d'autres trucs super cool comme le nombre de joueurs/teams maximum 
		$sql = "SELECT DISTINCT(t.id), t.startDate, t.endDate, t.description, t.typeTournament, t.status, t.nbMatch, t.idUserCreator, t.idGameVersion, t.idWinningTeam, t.urlProof, t.creationDate, t.guildOnly, t.randomPlayerMix, t.name, t.link, 
		gv.maxPlayer, gv.maxTeam, gv.maxPlayerPerTeam, gv.name as gvName, gv.description as gvDescription, 
		ga.id as gameId, ga.name as gameName, ga.description as gameDescription, ga.img as gameImg, ga.year as gameYear, ga.idType as gtId, 
		p.id as pId, p.name as pName, p.description as pDescription, p.img as pImg, 
		u.pseudo as userPseudo, 
		(SELECT COUNT(DISTINCT r.id) FROM register r WHERE r.idTournament = t.id) as numberRegistered
		FROM tournament t ";		
		// On est obligé de rajouter les % sur les values des array
		// 	les mettre dans la requete ne fonctionnant apparemment pas
		$sql .= " LEFT OUTER JOIN gameversion gv ON t.idgameVersion = gv.id";
		$sql .= " LEFT OUTER JOIN game ga ON ga.id = gv.idGame";
		$sql .= " LEFT OUTER JOIN platform p ON p.id = gv.idPlateform";
		$sql .= " LEFT OUTER JOIN user u ON u.id = t.idUserCreator";
		$sql .= " LEFT OUTER JOIN register r ON r.idTournament = t.id";
		$sql .= " WHERE t.idWinningTeam IS NULL";		
		$sql .= " GROUP BY t.id ORDER BY t.startDate LIMIT 0, ".$nb;


		$sth = $this->pdo->query($sql);
		$r = $sth->fetchAll(PDO::FETCH_ASSOC);
		if(isset($r[0])){
			$alltournaments = [];
			$r[0] = array_filter($r[0]);
			if(is_array($r[0])){
				foreach ($r as $key => $data) {
					if(count(array_filter($data)) > 0){
						$alltournaments[] = new tournament($data);
					}
				}
			}			
			return (count($alltournaments) > 0) ? $alltournaments : false;
		}
		return false;
	}

	public function getUnstartedTournaments(){
		if((bool)$this->pdo->query('SELECT COUNT(*) FROM tournament')->fetchColumn() === false)
			return false;
		// Ce gros morceau de requete permet d'alimenter un tournoi des noms de sa console, son jeu et plein d'autres trucs super cool comme le nombre de joueurs/teams maximum 
		$sql = "SELECT DISTINCT(t.id), t.startDate, t.endDate, t.description, t.typeTournament, t.status, t.nbMatch, t.idUserCreator, t.idGameVersion, t.idWinningTeam, t.urlProof, t.creationDate, t.guildOnly, t.randomPlayerMix, t.name, t.link, 
		gv.maxPlayer, gv.maxTeam, gv.maxPlayerPerTeam, gv.name as gvName, gv.description as gvDescription, 
		ga.id as gameId, ga.name as gameName, ga.description as gameDescription, ga.img as gameImg, ga.year as gameYear, ga.idType as gtId, 
		p.id as pId, p.name as pName, p.description as pDescription, p.img as pImg, 
		u.pseudo as userPseudo, 
		(SELECT COUNT(DISTINCT r.id) FROM register r WHERE r.idTournament = t.id) as numberRegistered
		FROM tournament t ";		
		// On est obligé de rajouter les % sur les values des array
		// 	les mettre dans la requete ne fonctionnant apparemment pas
		$sql .= " LEFT OUTER JOIN gameversion gv ON t.idgameVersion = gv.id";
		$sql .= " LEFT OUTER JOIN game ga ON ga.id = gv.idGame";
		$sql .= " LEFT OUTER JOIN platform p ON p.id = gv.idPlateform";
		$sql .= " LEFT OUTER JOIN user u ON u.id = t.idUserCreator";
		$sql .= " LEFT OUTER JOIN register r ON r.idTournament = t.id";
		$sql .= " WHERE t.startDate > UNIX_TIMESTAMP(LOCALTIME())";
		$sql .= " AND t.idWinningTeam IS NULL";
		$sql .= " GROUP BY t.id ORDER BY t.startDate";
		$sth = $this->pdo->query($sql);
		$r = $sth->fetchAll(PDO::FETCH_ASSOC);
		if(isset($r[0])){
			$alltournaments = [];
			foreach ($r as $key => $data) {
				$alltournaments[] = new tournament($data);
			}
			return $alltournaments;
		}
		return false;
	}

	public function getTournamentWithLink($link){
		if((bool)$this->pdo->query('SELECT COUNT(*) FROM tournament')->fetchColumn() === false)
			return false;
		$sql = "SELECT DISTINCT(t.id), t.startDate, t.endDate, t.description, t.typeTournament, t.status, t.nbMatch, t.idUserCreator, t.idGameVersion, t.idWinningTeam, t.urlProof, t.creationDate, t.guildOnly, t.randomPlayerMix, t.name, t.link, gv.maxPlayer, gv.maxTeam, gv.maxPlayerPerTeam, gv.name as gvName, gv.description as gvDescription, ga.id as gameId, ga.name as gameName, ga.description as gameDescription, ga.img as gameImg, ga.year as gameYear, ga.idType as gtId, p.id as pId, p.name as pName, p.description as pDescription, p.img as pImg, u.pseudo as userPseudo, (SELECT COUNT(DISTINCT r.id) FROM register r WHERE r.idTournament = t.id) as numberRegistered FROM tournament t ";
		// On est obligé de rajouter les % sur les values des array
		// 	les mettre dans la requete ne fonctionnant apparemment pas
		$sql .= " LEFT OUTER JOIN gameversion gv ON t.idgameVersion = gv.id";
		$sql .= " LEFT OUTER JOIN game ga ON ga.id = gv.idGame";
		$sql .= " LEFT OUTER JOIN platform p ON p.id = gv.idPlateform";
		$sql .= " LEFT OUTER JOIN user u ON u.id = t.idUserCreator";
		$sql .= " LEFT OUTER JOIN register r ON r.idTournament = t.id";
		$sql .= " WHERE t.link = :link";

		$sth = $this->pdo->prepare($sql, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
		$sth->execute([
			':link' => $link
		]);
		$r = $sth->fetchAll(PDO::FETCH_ASSOC);
		if(isset($r[0]))
			return new tournament($r[0]);
		return false;
	}

	public function setTournament(tournament $t, tournament $newt){
		$data = [];

		foreach (get_class_methods($newt) as $key => $method_name) {
			if(is_numeric(strpos($method_name, "get"))){
				$prop = strtolower(str_replace("get","",$method_name));
				$data[$prop] = ($prop==="pImg" || $prop==="gameImg") ? $newt->$method_name(true) : $newt->$method_name(); 
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
	
		$id = $t->getId();
		$query->bindParam(':id', $id, PDO::PARAM_INT);
		$query->execute();
	}

	// Cette fonction est là pour la recherche de tournois à venir par critere de nom / jeu / console
	public function getFilteredTournaments($searchArray = []){
		if((bool)$this->pdo->query('SELECT COUNT(*) FROM tournament')->fetchColumn() === false)
			return false;
		$sql = "SELECT DISTINCT(t.id), t.startDate, t.endDate, t.description, t.typeTournament, t.status, t.nbMatch, t.idUserCreator, t.idGameVersion, t.idWinningTeam, t.urlProof, t.creationDate, t.guildOnly, t.randomPlayerMix, t.name, t.link, gv.maxPlayer, gv.maxTeam, gv.maxPlayerPerTeam, gv.name as gvName, gv.description as gvDescription, ga.id as gameId, ga.name as gameName, ga.description as gameDescription, ga.img as gameImg, ga.year as gameYear, ga.idType as gtId, p.id as pId, p.name as pName, p.description as pDescription, p.img as pImg, u.pseudo as userPseudo, (SELECT COUNT(DISTINCT r.id) FROM register r WHERE r.idTournament = t.id) as numberRegistered FROM tournament t ";		
		// On est obligé de rajouter les % sur les values des array
		// 	les mettre dans la requete ne fonctionnant apparemment pas
		$sql .= " LEFT OUTER JOIN gameversion gv ON t.idgameVersion = gv.id";
		$sql .= " LEFT OUTER JOIN game ga ON ga.id = gv.idGame";
		$sql .= " LEFT OUTER JOIN platform p ON p.id = gv.idPlateform";
		$sql .= " LEFT OUTER JOIN user u ON u.id = t.idUserCreator";
		$sql .= " LEFT OUTER JOIN register r ON r.idTournament = t.id";
		$sql .= " WHERE t.startDate > UNIX_TIMESTAMP(LOCALTIME())";
		$sql .= " AND t.idWinningTeam IS NULL";
		$sql .= " GROUP BY t.id ORDER BY t.startDate";

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
		$r = $sth->fetchAll(PDO::FETCH_ASSOC);
		if(isset($r[0])){
			$alltournaments = [];
			foreach ($r as $key => $data) {
				$alltournaments[] = new tournament($data);
			}
			return $alltournaments;
		}
		return false;
	}

	public function getIdTournaments($id){
		$sql = "SELECT * FROM " .$this->table . " WHERE id=:id";

		$sth = $this->pdo->prepare($sql, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
		$sth->execute([ ':id' => $id ]);
		$r = $sth->fetchAll(PDO::FETCH_ASSOC);
		
		return new tournament($r[0]);
	}

	public function deleteTour(tournament $type){

		//Mise à -1 de tous les jeux ayant cet idType
		$sql = "UPDATE tournament set status = '-1' WHERE id=:id";
		$sth = $this->pdo->prepare($sql, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
		$sth->bindValue(':id', $type->getId());
		$sth->execute();
		return $sth->execute();
	}

	public function setTournamentWinner(tournament $t, teamtournament $tt){
		$sql = "UPDATE tournament SET idWinningTeam = :ttId WHERE id=:tId";
		$sth = $this->pdo->prepare($sql, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
		$r = $sth->execute([
			':ttId' => $tt->getId(),
			':tId' => $t->getId()
		]);
		return $sth->execute();
	}

	public function isNameUsed(tournament $t){
		$sql = "SELECT COUNT(*) FROM " . $this->table . " WHERE name=:name";
		$sth = $this->pdo->prepare($sql, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
		$sth->execute([
			':name' => $t->getName()
		]);
		$r = $sth->fetchAll();

		return (bool) $r[0][0];
	}

}
/*
*
*/
