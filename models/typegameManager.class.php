<?php
/*
*
*/
class typegameManager extends basesql{
	public function getAllTypes(){
		$sql = "SELECT * FROM TypeGame ORDER BY name";
		$sth = $this->pdo->query($sql);
		return $sth->fetchAll(PDO::FETCH_ASSOC);
	}
	public function getAllNames(){
		$sql = "SELECT name FROM TypeGame ORDER BY name";
		$sth = $this->pdo->query($sql);
		return $sth->fetchAll(PDO::FETCH_ASSOC);
	}
}
/*
*
*/