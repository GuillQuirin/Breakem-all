<?php
/*
*
*/
class typegameManager extends basesql{
	public function getAllTypes(){
		$sql = "SELECT * FROM typegame ORDER BY name";
		$sth = $this->pdo->query($sql);

		$typeGamesArr = [];
		foreach ($sth->fetchAll(PDO::FETCH_ASSOC) as $key => $arr) {
			$typeGamesArr[] = new typegame($arr);
		}
		return $typeGamesArr;
	}
}
/*
*
*/