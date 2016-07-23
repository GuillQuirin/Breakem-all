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
		$sql="SELECT c.id, c.comment, c.date, c.status,  
							(SELECT pseudo from user WHERE id=c.idUser) as pseudo,
							(SELECT name from team WHERE id=c.idEntite) as NomTeam
				FROM comment c
				ORDER BY c.date DESC";

		$req = $this->pdo->prepare($sql, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
		$req->execute();
		$list = [];
		while ($query = $req->fetch(PDO::FETCH_ASSOC))
			//tableau d'objets comment
			$list[] = new comment($query);
	
		return $list;
	}

	public function reportComment(comment $comment){
		if($comment->getStatus()==0)
			$sql = "UPDATE comment SET status=1 WHERE id=:id";
		
		$sth = $this->pdo->prepare($sql, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
		$sth->bindValue(':id', $comment->getId());
		$sth->execute();
	}
	
	public function editComment(comment $comment, $message){
		$sql = "UPDATE comment SET comment=:comment WHERE id=:id";
		
		$sth = $this->pdo->prepare($sql, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
		$sth->bindValue(':id', $comment->getId());
		$sth->bindValue(':comment', $message);
		$sth->execute();
	}

	public function delComment(comment $comment){

		$sql = ($comment->getStatus()==1) ? 
				"UPDATE comment SET status=0 WHERE id=:id" :
				"UPDATE comment SET status=1 WHERE id=:id";
		
		$sth = $this->pdo->prepare($sql, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
		$sth->bindValue(':id', $comment->getId());
		$sth->execute();
	}

	public function commentByPseudo(comment $u){
		$sql ="SELECT c.id, c.date, c.comment, c.status, c.idUser, c.idEntite
			   FROM comment c
			   LEFT OUTER JOIN user u
			   ON c.idUser = u.id
			   AND c.idUser IS NOT NULL
			   WHERE u.pseudo = :pseudo";
		$sth = $this->pdo->prepare($sql, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
		$sth->execute(["%".$u->getPseudo()."%"]);
		$r = $sth->fetchAll(PDO::FETCH_ASSOC);

		return $r;
	}

	public function setComment(comment $ancien, comment $nouveau){

		var_dump($ancien);

		$data = [];

		foreach (get_class_methods($nouveau) as $key => $method_name) {
			if(is_numeric(strpos($method_name, "get"))){
				$prop = strtolower(str_replace("get","",$method_name));
				$data[$prop] = ($prop==="img") ? $nouveau->$method_name(true) : $nouveau->$method_name(); 
			}
		}

		$data = array_filter($data);

		$compteur=0;

		$sql = "UPDATE ".$this->table." SET ";
			foreach ($data as $key => $value) {
				if($compteur!=0) 
					$sql.=", ";
				$sql.=" ".$key."=:".$key."";
				$compteur++;
			}
		$sql.=" WHERE id=:id";

		$query = $this->pdo->prepare($sql, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));

		//ATTENTION: on précise la référence de $value avec &
		foreach ($data as $key => &$value)
			$query->bindParam(':'.$key, $value);
	
		$id = $ancien->getId();
		$query->bindParam(':id', $id, PDO::PARAM_INT);
		$query->execute();

	}
}