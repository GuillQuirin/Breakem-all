<?php
/*
*
*/

final class teamtournamentManager extends basesql{
	
	public function createTournamentTeams(tournament $t){		
		$sql = "INSERT INTO teamtournament (idTournament) VALUES ";
		if($t->getMaxTeam() === 1){
			$sql.=  "(:idTournament)";
		}
		else{
			for ($i=0; $i < $t->getMaxTeam()-1; $i++) { 
				$sql.= "(:idTournament),";
			}
			$sql.=  "(:idTournament)";
		}
		$sth = $this->pdo->prepare($sql, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
		$r = $sth->execute([
			':idTournament' => $t->getId()
		]);
	}

	public function getFirstTeamTournament(tournament $t){
		$sql = "SELECT tt.id, tt.rank, tt.idTournament FROM teamtournament tt LEFT OUTER JOIN tournament t ON t.id = tt.idTournament WHERE t.id = :id ORDER BY tt.id LIMIT 0,1";
		$sth = $this->pdo->prepare($sql, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
		$r = $sth->execute([
			':id' => $t->getId()
		]);
		$r = $sth->fetchAll(PDO::FETCH_ASSOC);
		if(isset($r[0]))
			return new teamtournament($r[0]);
		return false;
	}

	public function getTournamentFreeTeams(tournament $t){
		// Compter le nombre de places restantes pour chaque team et les renvoyer si > 0
		$sql = "SELECT tt.id, tt.rank, tt.idTournament, COUNT(r.idTeamTournament) as takenPlaces 
		FROM teamtournament tt 
		LEFT OUTER JOIN register r 
		ON r.idTournament = tt.idTournament
		AND r.idTeamTournament = tt.id
		LEFT OUTER JOIN tournament t 
		ON t.id = tt.idTournament
		WHERE t.id = :id
		GROUP BY tt.id
		ORDER BY tt.id";

		$sth = $this->pdo->prepare($sql, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
		$r = $sth->execute([
			':id' => $t->getId()
		]);
		$r = $sth->fetchAll(PDO::FETCH_ASSOC);

		$allTournTeams = [];
		if(isset($r[0])){
			foreach ($r as $key => $datas) {
				$allTournTeams[] = new teamtournament($datas);
			}			
		}
		$allTournTeams = array_filter($allTournTeams);
		return ( count($allTournTeams) > 0 ) ? $allTournTeams : false;
	}
}

/*
*
SELECT tt.id FROM teamtournament tt LEFT OUTER JOIN tournament t ON t.id = tt.idTournament WHERE t.id = 11 ORDER BY tt.id LIMIT 0,1;

*/
?>