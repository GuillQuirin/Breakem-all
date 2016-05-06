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
	
	public function getBestGames(){        
         $sql = "SELECT G.name, COUNT(DISTINCT(T.idGameVersion)) as nb_util_jeu
                 FROM Tournament T, GameVersion GV, Game G
                WHERE G.id = GV.idGame AND GV.id = T.idGameVersion
                 LIMIT 0,3";
        $sth = $this->pdo->query($sql);
        return $sth->fetchAll(PDO::FETCH_ASSOC);
    }

	public function getGames(typegame $tg){		
		$sql = "SELECT name, description, img FROM " . $this->table . " WHERE idType= (SELECT id FROM typegame WHERE typegame.name = :name) ORDER BY name";
		$sth = $this->pdo->prepare($sql, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
		$sth->execute([
			':name' => $tg->getName()
		]);
		$r = $sth->fetchAll(PDO::FETCH_ASSOC);
		if(isset($r[0]))
			return $r;
		return false;
	}
}
/*
*
*/