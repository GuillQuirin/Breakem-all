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
                 FROM tournament T, gameversion GV, game G
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
		if(isset($r[0])){
			$data = [];
			foreach ($r as $key => $dataArr) {
				$data[] = new game($dataArr);
			}
			return $data;
		}
		return false;
	}

	public function setgame($infos){
		$sql = "INSERT INTO game (id, name, description, img, year, idType)"
	}
}
/*
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

*/