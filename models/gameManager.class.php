<?php
/*
*
*/
class gameManager extends basesql{
	
	public function getBestGames(){        
         $sql = "SELECT G.name, COUNT(DISTINCT(T.idGameVersion)) as nb_util_jeu, G.img
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
		$sql1 = "UPDATE game SET idType=-1 WHERE id=:id";
		$sth1 = $this->pdo->prepare($sql1, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));		
		$sth1->bindValue(':id', $platform->getId());
		$sth1->execute();

		$sql = "DELETE FROM " .$this->table . " WHERE id=:id";
		$sth = $this->pdo->prepare($sql, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));		
		$sth->bindValue(':id', $platform->getId());
		$sth->execute();
	}

	public function getAllGames(){
		$sql = "SELECT g.id, g.name, g.description, g.year, g.img, g.idType, t.name as nameType 
				FROM game g 
				INNER JOIN typegame t 
				ON g.idType = t.id
				ORDER BY name";
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

	public function setGame(game $ancien, game $nouveau){

		var_dump($ancien);

		$data = [];

		foreach (get_class_methods($nouveau) as $key => $method_name) {
			if(is_numeric(strpos($method_name, "get"))){
				$prop = strtolower(str_replace("get","",$method_name));
				$data[$prop] = ($prop==="img") ? $nouveau->$method_name(true) : $nouveau->$method_name(); 
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
	
		$id = $ancien->getId();
		$query->bindParam(':id', $id, PDO::PARAM_INT);
		$query->execute();

	}

}