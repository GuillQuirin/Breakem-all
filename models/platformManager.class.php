<?php
/*
*
*/
class platformManager extends basesql{
	public function getPlatforms(game $g){
		$sql = "SELECT name, description, img FROM " . $this->table . " WHERE idType= (SELECT id FROM game WHERE game.name = :name) ORDER BY name";
		$sth = $this->pdo->prepare($sql, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
		$sth->execute([
			':name' => $g->getName()
		]);
		$r = $sth->fetchAll(PDO::FETCH_ASSOC);
		if(isset($r[0]))
			return $r;
		return false;
	}

	public function getListPlatform(){
		$sql = "SELECT id, name, description, img FROM " . $this->table . " ORDER BY name ASC";
		
		$req = $this->pdo->prepare($sql, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
		$req->execute();
		$list = [];
		while ($query = $req->fetch(PDO::FETCH_ASSOC)) 
			//user appel la classe plateform
			$list[] = new platform($query);
		
		return $list;
	}

	//UPDATE LE STATUS DE LA TEAM DANS L'ADMIN
	public function changePlatform(platform $p){
		$sql = "UPDATE team SET status = :status WHERE id= :id";
		$req = $this->pdo->prepare($sql, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
		$req->execute([
			':status' => $t->getStatus(),
			':id' => $p->getId()
		]);
		$res = $req->fetchAll();
		if(isset($res[0]))
			return true;
		return false;
	}
}
/*
*
*/