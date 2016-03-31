<?php
class basesql{

	protected $table;
	protected $pdo;
	protected $columns = [];

	public function __construct(){
		$this->table = get_called_class();
		$this->table = str_replace("Manager", "", $this->table);
		// echo $this->table;
		$dsn = "mysql:dbname=".DBNAME.";host=".DBHOST;
		try{
			$this->pdo = new PDO($dsn,DBUSER,DBPWD);
		}catch(Exception $e){
			die("Erreur SQL : ".$e->getMessage());
		}
	
		//get_object_vars : retourner toutes les variables de mon objet
		$all_vars = get_object_vars($this);
		//get_class permet de récuperer le nom de la class
		//get_class_vars : permet de récupérer les variables de la classe
		$class_vars = get_class_vars(get_class());
		$this->columns = array_keys(array_diff_key($all_vars,$class_vars));
		//print_r($this->columns);
	}

	public function save(){
		//Elle doit faire soit un INSERT ou UPDATE Quand il n'y a pas d'id on fait un INSERT
		// if(is_numeric($this->id)){
		// 	//UPDATE
		// }else{
			//INSERT
			$sql = "INSERT INTO ".$this->table." (".implode(",",array_keys($this->columns)).")
			VALUES (:".implode(",:", array_keys($this->columns)).")";
			$query = $this->pdo->prepare($sql);
			var_dump($sql);
			foreach($this->columns as $key => $value){
				$data[$key] = $value;
			}
			var_dump($data);
			$r = $query->execute($data);
			var_dump($r);
		// }
	}
	
	public function idExists($id){
		$sql = 'SELECT COUNT(*) FROM ' . $this->table . ' WHERE id="' . $id.'"';
		$r = (bool) $this->pdo->query($sql)->fetchColumn();

		return $r;
	}

	public function pseudoExists($pseudo){
		$sql = 'SELECT COUNT(*) FROM ' . $this->table . ' WHERE pseudo="' . $pseudo.'"';
		$r = (bool) $this->pdo->query($sql)->fetchColumn();

		return $r;
	}

	public function emailExists($email){		
		$sql = 'SELECT COUNT(*) FROM ' . $this->table . ' WHERE email="' . $email .'"'; 
		$r = (bool) $this->pdo->query($sql)->fetchColumn();

		return $r;
	}

	public function getUser(array $infos){
		
		$cols = array_keys($infos);
		$data = [];
		foreach ($cols as $key) {
			$data[$key] = $key.'="'.$infos[$key].'"';
		}
		$sql = "SELECT name, firstname, pseudo, birthday, description, kind, city, email, status, img_user, idTeam FROM ".$this->table." WHERE " . implode(',', $data);
		// var_dump($sql);
		$query = $this->pdo->query($sql)->fetch();
		if($query === FALSE)
			return false;
		return new user(array_filter($query));
	}
}
