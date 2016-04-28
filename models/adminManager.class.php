<?php

class adminManager extends basesql{
	public function __construct(){
		parent::__construct();
	}

	public function getListUser(){
		$sql = "SELECT id, name, firstname, pseudo, birthday, description, kind, city, email, status, img, idTeam, isConnected, lastConnexion FROM User ";
		$query = $this->pdo->query($sql)->fetchAll();
		
		if($query === FALSE)
			return false;

		return $query;
	}
}