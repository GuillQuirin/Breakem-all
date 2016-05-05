<?php
/*
*
*/
class gameversionManager extends basesql{
	public function getAvailablePlatforms(game $g){		
		$sql = "SELECT DISTINCT(idPlateform), platform.name, platform.description, platform.img FROM " . $this->table . ", platform WHERE gameversion.idGame= (SELECT id FROM game WHERE game.name = :name) AND idPlateform = platform.id ORDER BY platform.name";
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

// SELECT DISTINCT(idPlateform), platform.name FROM gameversion, platform WHERE gameversion.idGame= (SELECT id FROM game WHERE game.name = 'battlefield 3') AND idPlateform = platform.id;