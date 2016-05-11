<?php

class adminManager extends basesql{
	public function __construct(){
		parent::__construct();
	}

	//Membre
	public function getListUser(){
		$sql="SELECT user.id, user.name, user.firstname, user.pseudo, 
						user.birthday, user.description, user.kind, user.city, 
						user.email, user.status, user.img, user.idTeam, user.isConnected, user.lastConnexion,
						COUNT(id_signaled_user) as reportNumber
					FROM user 
					LEFT JOIN signalmentsuser 
							ON user.id = signalmentsuser.id_signaled_user 
					GROUP BY user.id";

		$sth = $this->pdo->prepare($sql, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
		$sth->execute();
		$list = [];
		while ($query = $sth->fetch(PDO::FETCH_ASSOC))
			//tableau d'objets user
			$list[] = new user($query);

		return $list;
	}

	//Plateforme
	public function getListPlatform(){
		$sql = "SELECT id, name, description, img FROM platform ORDER BY name ASC";
		
		$sth = $this->pdo->prepare($sql, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
		$sth->execute();
		$list = [];
		while ($query = $sth->fetch(PDO::FETCH_ASSOC)) 
			//user appel la classe plateform
			$list[] = new platform($query);
		
		return $list;
	}
}