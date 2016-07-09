<?php
/*
*
*/
final class matchsManager extends basesql{
	public function getMatchsOfTournament(tournament $t){
		$sql = "SELECT DISTINCT(m.id), m.idWinningTeam, m.proof, m.idTournament, m.startDate, m.matchNumber 
		FROM matchs m ";
		$sql .= " LEFT OUTER JOIN matchparticipants mp ON mp.idMatch = m.id";
		$sql .= " WHERE m.idTournament = :idTournament";
		// echo $sql;
		$sth = $this->pdo->prepare($sql, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
		$sth->execute([
			':idTournament' => $t->getId()
		]);
		$r = $sth->fetchAll(PDO::FETCH_ASSOC);
		if(isset($r[0])){
			$allMatchs = [];
			$r[0] = array_filter($r[0]);
			if(is_array($r[0])){
				foreach ($r as $key => $data) {
					if(count(array_filter($data)) > 0)
						$allMatchs[] = new matchs($data);
				}
			}			
			return (count($allMatchs) > 0) ? $allMatchs : false;
		}
		return false;
	}

}
/*
*
*/