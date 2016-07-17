<?php
/*
*
*/
class typegameManager extends basesql{
	
	public function getTypeGame($id){
		$sql = "SELECT *
				FROM typegame 
				WHERE id=:id
				AND id>0";

		$sth = $this->pdo->prepare($sql, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
		$sth->execute([ ':id' => $id ]);
		$r = $sth->fetchAll(PDO::FETCH_ASSOC);
		return new typegame($r[0]);
	}

	public function getAllTypes(){
		$sql = "SELECT * FROM typegame WHERE id>0 ORDER BY name";
		$sth = $this->pdo->query($sql);

		$typeGamesArr = [];
		foreach ($sth->fetchAll(PDO::FETCH_ASSOC) as $key => $arr) {
			$typeGamesArr[] = new typegame($arr);
		}
		return $typeGamesArr;
	}

	public function isNameUsed(typegame $t){
		$sql = "SELECT COUNT(*) FROM " . $this->table . " WHERE name=:name";
		$sth = $this->pdo->prepare($sql, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
		$sth->execute([
			':name' => $t->getName()
		]);
		$r = $sth->fetchAll();

		return (bool) $r[0][0];
	}

	public function setTypeGame(typegame $ancien, typegame $nouveau){
		$data = [];

		foreach (get_class_methods($nouveau) as $key => $method_name) {
			if(is_numeric(strpos($method_name, "get"))){
				$prop = strtolower(str_replace("get","",$method_name));
				$data[$prop] = $nouveau->$method_name(); 
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

	public function delTypeGame(typegame $type){

		//Mise à -1 de tous les jeux ayant cet idType
		$sql = "UPDATE game set idType = '-1' WHERE idType=:idType";
		$sth = $this->pdo->prepare($sql, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
		$sth->bindValue(':idType', $type->getId());
		$sth->execute();

		//Suppression du type
		$sql = "DELETE FROM typegame WHERE id=:id";
		$sth = $this->pdo->prepare($sql, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
		$sth->bindValue(':id', $type->getId());
		$sth->execute();
	}


}
/*
*
*/