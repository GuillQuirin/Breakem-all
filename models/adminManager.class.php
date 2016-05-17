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

		$req = $this->pdo->prepare($sql, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
		$req->execute();
		$list = [];
		while ($query = $req->fetch(PDO::FETCH_ASSOC))
			//tableau d'objets user
			$list[] = new user($query);

		return $list;
	}

	//Signalements
	public function getListReports(){
		$sql="SELECT *
					FROM signalmentsuser 
					ORDER BY id ASC";

		$req = $this->pdo->prepare($sql, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
		$req->execute();
		$list = [];
		while ($query = $req->fetch(PDO::FETCH_ASSOC))
			//tableau d'objets user
			$list[] = new signalmentsuser($query);
	
		return $list;
	}
	
	//Team
	public function getListTeam(){
		$sql="SELECT id, name, img, slogan, description,status FROM team ORDER BY name ASC";

		$req = $this->pdo->prepare($sql, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
		$req->execute();
		$list = [];
		while ($query = $req->fetch(PDO::FETCH_ASSOC))
			//tableau d'objets team
			$list[] = new team($query);
	
		return $list;
	}
	//UPDATE LE STATUS DE LA TEAM DANS L'ADMIN
	public function changeStatusTeam(team $t){
		$sql = "UPDATE team SET status = :status WHERE id= :id";
		$req = $this->pdo->prepare($sql, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
		$req->execute([
			':status' => $t->getStatus(),
			':id' => $t->getId()
		]);
		$res = $req->fetchAll();
		if(isset($res[0]))
			return true;
		return false;
	}
}