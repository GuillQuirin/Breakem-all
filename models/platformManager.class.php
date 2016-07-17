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
		$sql = "SELECT id, name, description, img, status FROM " . $this->table . " WHERE id>=0 ORDER BY name ASC";
		
		$req = $this->pdo->prepare($sql, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
		$req->execute();
		$list = [];
		while ($query = $req->fetch(PDO::FETCH_ASSOC)) 
			//user appel la classe plateform
			$list[] = new platform($query);
		
		return $list;
	}

	public function getAdminListPlatform(){
		$sql = "SELECT id, name, description, img, status FROM " . $this->table . " WHERE id>=0 AND status>0 ORDER BY name ASC";
		
		$req = $this->pdo->prepare($sql, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
		$req->execute();
		$list = [];
		while ($query = $req->fetch(PDO::FETCH_ASSOC)) 
			//user appel la classe plateform
			$list[] = new platform($query);
		
		return $list;
	}

	public function deletePlatform(platform $platform){
		$sql1 = "UPDATE gameversion SET idPlateform=-1 WHERE idPlateform=:id";
		$sth1 = $this->pdo->prepare($sql1, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));		
		$sth1->bindValue(':id', $platform->getId());
		$sth1->execute();

		$sql = "DELETE FROM " .$this->table . " WHERE id=:id";
		$sth = $this->pdo->prepare($sql, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));		
		$sth->bindValue(':id', $platform->getId());
		$sth->execute();
	}

	public function getIdPlatform($id){
		$sql = "SELECT * FROM " .$this->table . " WHERE id=:id";

		$sth = $this->pdo->prepare($sql, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
		$sth->execute([ ':id' => $id ]);
		$r = $sth->fetchAll(PDO::FETCH_ASSOC);
		
		return new platform($r[0]);
	}

	public function setPlatform(platform $ancien, platform $nouveau){

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
/*
*
*/