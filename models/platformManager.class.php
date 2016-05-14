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
}
/*
*
*/