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
	public function getTeamTournamentUsers(teamtournament $tt){
		$sql = "SELECT u.id, u.status, u.pseudo, u.description, u.email, u.idTeam, u.img, u.isConnected, u.lastConnexion, u.authorize_mail_contact FROM register r";
		// On est obligé de rajouter les % sur les values des array
		// 	les mettre dans la requete ne fonctionnant apparemment pas
		$sql .= " LEFT OUTER JOIN user u ON u.id = r.idUser";
		$sql .= " WHERE r.idTeamTournament = :id";
		

		$sth = $this->pdo->prepare($sql, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
		$sth->execute([
			':id' => $tt->getId()
		]);
		$r = $sth->fetchAll(PDO::FETCH_ASSOC);
		$allUsers = [];
		if(isset($r[0])){
			foreach ($r as $key => $data) {
				if(count(array_filter($data)) > 0)
					$allUsers[] = new user($data);
			}
		}
		return (count($allUsers) > 0) ? $allUsers : false;
	}
	public function isUserRegisteredForTournament(tournament $t, user $u){
		$sql = "SELECT COUNT(*) as nb FROM register WHERE idTournament = :idTournament AND idUser = :idUser";		

		$sth = $this->pdo->prepare($sql, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
		$sth->execute([
			':idTournament' => $t->getId(),
			':idUser' => $u->getId()
		]);
		$r = $sth->fetch(PDO::FETCH_ASSOC);
		if(isset($r['nb']))			
			return (bool) (int) $r['nb'];
		return false;
	}
}
/*
*
*/
