<?php
/*
*
*/
class typegameManager extends basesql{

	public function getTypeGame($id){
		$sql = "SELECT *
				FROM typegame 
				WHERE id=:id";

		$sth = $this->pdo->prepare($sql, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
		$sth->execute([ ':id' => $id ]);
		$r = $sth->fetchAll(PDO::FETCH_ASSOC);
		return new typegame($r[0]);
	}

	public function getAllTypes(){
		$sql = "SELECT * FROM typegame ORDER BY name";
		$sth = $this->pdo->query($sql);

		$typeGamesArr = [];
		foreach ($sth->fetchAll(PDO::FETCH_ASSOC) as $key => $arr) {
			$typeGamesArr[] = new typegame($arr);
		}
		return $typeGamesArr;
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