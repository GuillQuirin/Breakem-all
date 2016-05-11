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
			$list[] = new user($query);
		
		return $list;
	}

	//Tournoi
	public function getListTournament(){
		$sql = "SELECT id, name, firstname, pseudo, birthday, description, kind, city, email, status, img, idTeam, isConnected, lastConnexion FROM User ORDER BY pseudo ASC";
		
		$sth = $this->pdo->prepare($sql, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
		$sth->execute();
		$query = $sth->fetchAll(PDO::FETCH_ASSOC);

		if($query === FALSE)
			return false;

		return $query;
	}
	
	//Team
	public function getListTeam(){
		$sql = "SELECT id, name, firstname, pseudo, birthday, description, kind, city, email, status, img, idTeam, isConnected, lastConnexion FROM User ORDER BY pseudo ASC";
		
		$sth = $this->pdo->prepare($sql, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
		$sth->execute();
		$query = $sth->fetchAll(PDO::FETCH_ASSOC);

		if($query === FALSE)
			return false;

		return $query;
	}

	//Commentaire
	public function getListComs(){
		$sql = "SELECT id, name, firstname, pseudo, birthday, description, kind, city, email, status, img, idTeam, isConnected, lastConnexion FROM User ORDER BY pseudo ASC";
		
		$sth = $this->pdo->prepare($sql, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
		$sth->execute();
		$query = $sth->fetchAll(PDO::FETCH_ASSOC);

		if($query === FALSE)
			return false;

		return $query;
	}
}