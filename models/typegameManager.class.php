<?php
/*
*
*/
class typegameManager extends basesql{
	public function getAllTypes(){
		$sql = "SELECT * FROM typegame WHERE (Select COUNT(*) FROM game where idtype= typegame.id) > 0";
		$sth = $this->pdo->query($sql);
		return $sth->fetchAll(PDO::FETCH_ASSOC);
	}
}
/*
*
*/