<?php
/*
*
*/
class gameManager extends basesql{
	
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

	public function getGameById($id){		
		$sql = "SELECT * FROM " . $this->table . " WHERE id=:id";
		$sth = $this->pdo->prepare($sql, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
		$sth->execute([
			':id' => $id
		]);

		$r = $sth->fetchAll(PDO::FETCH_ASSOC);
		if(isset($r[0]))
			return new game($r[0]);
		else
			return null;
	}

	/*public function isGame($name){
		$sql = "SELECT COUNT(*) as nb FROM game WHERE name = '" . $name['delname']."'";

		$sth = $this->pdo->prepare($sql, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
		$sth->execute();
		$r = $sth->fetch(PDO::FETCH_ASSOC);
		if(isset($r['nb']))
			return (bool) (int) $r['nb'];
		return false;
	}*/

	public function deleteGames(game $game){
		$sql = "DELETE FROM game WHERE id=:id";
		$sth = $this->pdo->prepare($sql, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
		$sth->bindValue(':id', $game->getId());
		$sth->execute();
	}

	public function getAllGames(){
		$sql = "SELECT * FROM game ORDER BY name";
		$sth = $this->pdo->prepare($sql, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
		$sth->execute();
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

}