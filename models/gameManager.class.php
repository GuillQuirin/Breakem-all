<?php
/*
*
*/
class gameManager extends basesql{
	/*public function getAllTypes(){
		$sql = "SELECT DISTINCT(type) FROM ".$this->table;
		$sth = $this->pdo->query($sql);
		return $sth->fetchAll(PDO::FETCH_ASSOC);
	}*/
	
	public function bestGames(){
		
		$sql = "SELECT G.name, COUNT(DISTINCT(T.idGameVersion)) as nb_util_jeu
				FROM Tournament T, GameVersion GV, Game G
				WHERE G.id = GV.idGame AND GV.id = T.idGameVersion
				LIMIT 0,3";
		$sth = $this->pdo->query($sql);
		return $sth->fetchAll(PDO::FETCH_ASSOC);
	}
}
/*
*
*/