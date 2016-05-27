<?php 

class commentsteamManager extends basesql{
	public function __construct(){
		parent::__construct();
	}

	public function getComment($id){
		$sql = "SELECT *
				FROM commentsteam 
				WHERE id=:id";

		$sth = $this->pdo->prepare($sql, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
		$sth->execute([ ':id' => $id ]);
		$r = $sth->fetchAll(PDO::FETCH_ASSOC);
		
		return new commentsteam($r[0]);
	}

	public function getAllComment(){
			// Sous requete SQL pour recuperer les pseudos
		$sql="SELECT c.id, c.message, c.date, 
							(SELECT pseudo from user WHERE id=c.idUser) as pseudo,
							(SELECT name from team WHERE id=c.idTeam) as NomTeam
				FROM commentsteam c
				ORDER BY id ASC";

		$req = $this->pdo->prepare($sql, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
		$req->execute();
		$list = [];
		while ($query = $req->fetch(PDO::FETCH_ASSOC))
			//tableau d'objets user
			$list[] = new commentsteam($query);
	
		return $list;
	}

	public function delComment(commentsteam $comment){
		$sql = "DELETE FROM commentsteam WHERE id=:id";
		
		$sth = $this->pdo->prepare($sql, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
		$sth->bindValue(':id', $comment->getId());
		$sth->execute();
	}

}