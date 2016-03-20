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

	protected function save(){
		//Elle doit faire soit un INSERT ou UPDATE Quand il n'y a pas d'id on fait un INSERT
		if(is_numeric($this->id)){
			//UPDATE
		}else{
			//INSERT
			$sql = "INSERT INTO ".$this->table." (".implode(",",$this->columns).")
			VALUES (:".implode(",:", $this->columns).")";
			$query = $this->pdo->prepare($sql);

			foreach($this->columns as $columns){
				$data[$columns] = $this->$columns;
			}
			$query->execute($data);
		}
	}

<<<<<<< HEAD
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
}
