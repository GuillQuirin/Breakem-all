<?php 

class commentManager extends basesql{
	public function __construct(){
		parent::__construct();
	}

	public function getComment($id){
		$sql = "SELECT *
				FROM comment 
				WHERE id=:id";

		$sth = $this->pdo->prepare($sql, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
		$sth->execute([ ':id' => $id ]);
		$r = $sth->fetchAll(PDO::FETCH_ASSOC);
		
		return new comment($r[0]);
	}

	public function getCommentsByTeam(team $team){
		$sql = "SELECT c.id, c.date, c.comment, c.status, c.idUser, c.idEntite as idTeam,
							(SELECT pseudo from user WHERE id=c.idUser) as pseudo,
							(SELECT name from team WHERE id=c.idEntite) as nomTeam,
							(SELECT img from user WHERE id=c.idUser) as img
				FROM comment c
				WHERE c.idEntite=:idEntite 
					AND c.entite=1";
		
		$req = $this->pdo->prepare($sql, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
		$req->execute([ ':idEntite' => $team->getId() ]);

		$list = [];
		while ($query = $req->fetch(PDO::FETCH_ASSOC))
			//tableau d'objets comment
			$list[] = new comment($query);

		return $list;
	}

	public function getAllComment(){
			// Sous requete SQL pour recuperer les pseudos
		$sql="SELECT c.id, c.message, c.date, c.status,  
							(SELECT pseudo from user WHERE id=c.idUser) as pseudo,
							(SELECT name from team WHERE id=c.idTeam) as NomTeam
				FROM comment c
				ORDER BY id ASC";

		$req = $this->pdo->prepare($sql, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
		$req->execute();
		$list = [];
		while ($query = $req->fetch(PDO::FETCH_ASSOC))
			//tableau d'objets comment
			$list[] = new comment($query);
	
		return $list;
	}

	public function delComment(comment $comment){

		$sql = ($comment->getStatus()==1) ? 
				"UPDATE comment SET status=0 WHERE id=:id" :
				"UPDATE comment SET status=1 WHERE id=:id";
		
		$sth = $this->pdo->prepare($sql, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
		$sth->bindValue(':id', $comment->getId());
		$sth->execute();
	}

}