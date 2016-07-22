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

	public function getNextAllMatch(tournament $t, $limit=5){
		$limit = (int) $limit;
		if($limit < 1)
			$limit = 5;
		$sql = "SELECT m.id, m.idWinningTeam, m.proof, m.idTournament, m.startDate, m.matchNumber
		FROM matchs m 
		WHERE m.idTournament = :idTournament
		ORDER BY m.id DESC
		LIMIT 0,".$limit;

		$sth = $this->pdo->prepare($sql, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
		$sth->execute();
		$r = $sth->fetchAll(PDO::FETCH_ASSOC);
		// print_r($r);
		if(isset($r[0])){
			$r[0] = array_filter($r[0]);
			if(is_array($r[0]))
				return new matchs($r[0]);
		}
		return false;
	}
}
/*
*
*/