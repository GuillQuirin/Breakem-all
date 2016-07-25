<?php
/*
*
*/
final class matchParticipantsManager extends basesql{
	public function setPointsOfTeamTournamentInMatch(matchs $m, $pointsWinner, $pointsLoser){
		$sql = "UPDATE matchParticipants SET points = CASE
		    WHEN idTeamTournament = (SELECT idWinningTeam FROM matchs WHERE matchs.id = :mId) THEN :pointsWinner
		    ELSE :pointsLoser
		    END";
		$sql .= " WHERE idMatch = :mId";
		$sth = $this->pdo->prepare($sql, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
		$r = $sth->execute([
			':mId' => $m->getId(),
			':pointsWinner' => $pointsWinner,
			':pointsLoser' => $pointsLoser
		]);
		return $r;
	}

	public function getTotalPointsOfUser(user $u){
		$sql = "SELECT SUM(points) as totalPoints FROM matchParticipants mp";
		$sql .= " INNER JOIN register r ";
		$sql .= " ON r.idTeamTournament = mp.idTeamTournament ";
		$sql .= " AND r.idUser = :uId ";

		$sth = $this->pdo->prepare($sql, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
		$r = $sth->execute([
			':uId' => $u->getId()
		]);
		$r = $sth->fetchAll(PDO::FETCH_ASSOC);
		if(isset($r[0]['totalPoints']))
			return (int) $r[0]['totalPoints'];
		return false;
	}
}
/*
*
*/