<?php

class adminManager extends basesql{
	public function __construct(){
		parent::__construct();
	}

	//Membre
	public function getListUser(){
		$sql = "SELECT id, name, firstname, pseudo, birthday, description, kind, city, email, status, img, idTeam, isConnected, lastConnexion FROM User ORDER BY pseudo ASC";
		
		$sth = $this->pdo->prepare($sql, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
		$sth->execute();
		$list = [];
		while ($query = $sth->fetch(PDO::FETCH_ASSOC)) 
			//user appel la classe user
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