<?php
class basesql{

	private $table;
	private $pdo;
	private $columns = [];

	public function __construct(){
	
		$this->table = get_called_class();
		//echo $this->table;
		$dsn = 'mysql:dbname='.DBNAME.';host='.DBHOST;
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
		if(is_numeric($this->id)){
			//UPDATE
		}else{
			//INSERT
			$sql = "INSERT INTO ".$this->table." (".implode(",",$this->columns).")
			VALUES (:".implode(",:", $this->columns).")";
			//echo $sql;
			$query = $this->pdo->prepare($sql);

			foreach($this->columns as $columns){
				$data[$columns] = $this->$columns;
			}
			$query->execute($data);
		}
	}
}