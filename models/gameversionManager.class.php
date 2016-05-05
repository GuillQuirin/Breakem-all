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

	// Cette fonction ne fonctionnera qu'en la présence des variables sessions créées lors des étapes succintes de la création d'un tournoi en Ajax
	public function getAvailableVersions(platform $p){
		$sql = "SELECT maxPlayer, maxTeam, maxPlayerPerTeam, name, description  FROM " . $this->table . " WHERE idPlateform = (SELECT id FROM platform WHERE name = :platName) AND idGame = (SELECT id FROM game WHERE name = :gameName)";
		$sth = $this->pdo->prepare($sql, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
		$sth->execute([
			':platName' => $p->getName(),
			':gameName' => $_SESSION['gamename']
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
