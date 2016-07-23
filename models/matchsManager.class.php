<?php
/*
*
*/
final class matchsManager extends basesql{
	public function getMatchsOfTournament(tournament $t, $returnEvenIfEmpty = false){
		$sql = "SELECT DISTINCT(m.id), m.idWinningTeam, m.proof, m.idTournament, m.startDate, m.matchNumber 
		FROM matchs m 
		LEFT OUTER JOIN matchparticipants mp ON mp.idMatch = m.id
		WHERE m.idTournament = :idTournament";
		// echo $sql;
		$sth = $this->pdo->prepare($sql, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
		$sth->execute([
			':idTournament' => $t->getId()
		]);
		$r = $sth->fetchAll(PDO::FETCH_ASSOC);
		$allMatchs = [];
		if(isset($r[0])){			
			$r[0] = array_filter($r[0]);
			if(is_array($r[0])){
				foreach ($r as $key => $data) {
					if(count(array_filter($data)) > 0)
						$allMatchs[] = new matchs($data);
				}
			}
			if($returnEvenIfEmpty === false)		
				return (count($allMatchs) > 0) ? $allMatchs : false;
			else
				return (count($allMatchs) > 0) ? $allMatchs : "none";
		}
		if($returnEvenIfEmpty === false)
			return false;
		else
			return (count($allMatchs) > 0) ? $allMatchs : "none";
		
	}

	public function getLastCreatedMatchOfTournament(tournament $t){
		$sql = "SELECT m.id, m.idWinningTeam, m.proof, m.idTournament, m.startDate, m.matchNumber
		FROM matchs m 
		WHERE m.idTournament = :idTournament
		ORDER BY m.id DESC
		LIMIT 0,1
		";

		$sth = $this->pdo->prepare($sql, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
		$sth->execute([
			':idTournament' => $t->getId()
		]);
		$r = $sth->fetchAll(PDO::FETCH_ASSOC);
		// print_r($r);
		if(isset($r[0])){
			$r[0] = array_filter($r[0]);
			if(is_array($r[0]))
				return new matchs($r[0]);
		}
		return false;
	}

	public function setMatchWinner(matchs $m, teamtournament $tt){
		$sql = "UPDATE matchs set idWinningTeam = :tId WHERE id=:mId";
		$sth = $this->pdo->prepare($sql, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
		$r = $sth->execute([
			':tId' => $tt->getId(),
			':mId' => $m->getId()
		]);
		return $sth->execute();
	}

	
	/*
		@params = (int) limit of matchs to return
		@returns (array) of MATCHS || (boolean) false if no matchs found
		#### Ne récupère qu'un match -non joué-  maxi / tournoi ####
	*/
	public function getNextMatchsOfEveryTournament($limit=5){
		$limit = (int) $limit;
		if($limit < 1)
			$limit = 5;
		$sql = "SELECT id, idWinningTeam, proof, idTournament, startdate, MAX(matchnumber) as matchNumber"; 
		$sql .= " FROM matchs";
		// IS NULL = match pas encore joué   &  IS NOT NULL = déjà joués
		$sql .= " WHERE idWinningTeam IS NULL";
		$sql .= " GROUP BY idtournament order by startdate";
		$sql .= " LIMIT 0, 5";

		$sth = $this->pdo->prepare($sql, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
		$sth->execute();
		$r = $sth->fetchAll(PDO::FETCH_ASSOC);
		// var_dump($r);
		if( isset($r[0]) ){
			$matchs = [];
			foreach ($r as $datas) {
				if(count(array_filter($datas)) > 0)
					$matchs[] = new matchs($datas);
			}
			return (count($matchs) > 0) ? $matchs : false;
		}
		return false;
	}
}
/*
*
*/
