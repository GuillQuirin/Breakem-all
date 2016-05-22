<?php
/*
*
*/
final class registerManager extends basesql{

	public function getTournamentParticipants(tournament $t){
		$sql = "SELECT r.id, r.status, r.idTeamTournament, r.idUser, r.idTournament, u.pseudo, u.description, u.email, u.idTeam, u.img, u.isConnected, u.lastConnexion, u.authorize_mail_contact FROM register r";
		// On est obligé de rajouter les % sur les values des array
		// 	les mettre dans la requete ne fonctionnant apparemment pas
		$sql .= " LEFT OUTER JOIN user u ON u.id = r.idUser";
		$sql .= " WHERE r.idTournament = :id";
		

		$sth = $this->pdo->prepare($sql, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
		$sth->execute([
			':id' => $t->getId()
		]);
		$r = $sth->fetchAll(PDO::FETCH_ASSOC);
		$allRegistered = [];
		if(isset($r[0])){
			foreach ($r as $key => $data) {
				if(count(array_filter($data)) > 0)
					$allRegistered[] = new register($data);
			}
		}
		return (count($allRegistered) > 0) ? $allRegistered : false;
	}
}
/*
*
*/
