<?php 

class signalmentsuserManager extends basesql{
	public function __construct(){
		parent::__construct();
	}

	public function isReport($demandeur, $accuse){
		$sql = "SELECT COUNT(*) as nb 
				FROM signalmentsuser 
				WHERE id_indic_user=:id_indic_user 
						AND id_signaled_user=:id_signaled_user";

		$sth = $this->pdo->prepare($sql, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
		$sth->execute([
			':id_indic_user' => $demandeur,
			':id_signaled_user' => $accuse
		]);
		$r = $sth->fetchAll(PDO::FETCH_ASSOC);

		return $r[0]['nb'];
	}

	public function getReport($id){
		$sql = "SELECT *
				FROM signalmentsuser 
				WHERE id=:id";

		$sth = $this->pdo->prepare($sql, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
		$sth->execute([ ':id' => $id ]);
		$r = $sth->fetchAll(PDO::FETCH_ASSOC);
		
		return new signalmentsuser($r[0]);
	}

	public function getAdminListReports(){
		// Sous requete SQL pour recuperer les pseudos
		$sql="SELECT s.id, s.subject, s.description, s.date, 
							(SELECT pseudo from user WHERE id=s.id_indic_user) as pseudo_indic_user,
							(SELECT pseudo from user WHERE id=s.id_signaled_user) as pseudo_signaled_user
				FROM signalmentsuser s
				ORDER BY id ASC";

		$req = $this->pdo->prepare($sql, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
		$req->execute();
		$list = [];
		while ($query = $req->fetch(PDO::FETCH_ASSOC))
			//tableau d'objets user
			$list[] = new signalmentsuser($query);
	
		return $list;
	}

	public function getIdReport($id){
		$sql = "SELECT * FROM " .$this->table . " WHERE id=:id";

		$sth = $this->pdo->prepare($sql, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
		$sth->execute([ ':id' => $id ]);
		$r = $sth->fetchAll(PDO::FETCH_ASSOC);
		
		return new signalmentsuser($r[0]);
	}


	public function delReport(signalmentsuser $report){
		$sql = "DELETE FROM signalmentsuser WHERE id=:id";
		
		$sth = $this->pdo->prepare($sql, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
		$sth->bindValue(':id', $report->getId());
		$sth->execute();
	}

	public function setReport(signalmentsuser $ancien, signalmentsuser $nouveau){

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

	public function reportByPseudo($searchArray = []){
		$sql ="SELECT u.pseudo, u.id, s.date, s.description, s.subject, s.id_indic_user, s.id_signaled_user
      			FROM signalmentsuser s
      			LEFT OUTER JOIN user u ON s.id_signaled_user = u.id";
		
		if(is_array($searchArray) && isset($searchArray['pseudo'])){
			$sql .= " WHERE u.pseudo LIKE ?";
		};

		$sth = $this->pdo->prepare($sql, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
		$sth->execute(['%'.$searchArray['pseudo'].'%']);
		$r = $sth->fetchAll(PDO::FETCH_ASSOC);

		return $r;
	}
}