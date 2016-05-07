<?php
class basesql{

	protected $table;
	protected $pdo;
	protected $columns = [];

	public function __construct(){
		$this->table = get_called_class();
		$this->table = str_replace("Manager", "", $this->table);

		$dsn = "mysql:dbname=".DBNAME.";host=".DBHOST;
		try{
			$this->pdo = new PDO($dsn,DBUSER,DBPWD, array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES 'utf8'"));
		}catch(Exception $e){
			die("Erreur SQL : ".$e->getMessage());
		}
	
		//get_object_vars : retourner toutes les variables de mon objet
		$all_vars = get_object_vars($this);
		//get_class permet de récuperer le nom de la class
		//get_class_vars : permet de récupérer les variables de la classe
		$class_vars = get_class_vars(get_class());
		$this->columns = array_keys(array_diff_key($all_vars,$class_vars));
	}

	public function save(){
		$sql = "INSERT INTO ".$this->table." (".implode(",",array_keys($this->columns)).")
		VALUES (:".implode(",:", array_keys($this->columns)).")";

		$query = $this->pdo->prepare($sql, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));

		foreach($this->columns as $key => $value){
			$data[$key] = $value;
		}

		$query->execute($data);
	}
	

	public function idExists($id){
		$sql = 'SELECT COUNT(*) FROM ' . $this->table . ' WHERE id="'.$id.'"';
		$r = (bool) $this->pdo->query($sql)->fetchColumn();

		return $r;
	}

	public function pseudoExists($pseudo){
		$sql = 'SELECT COUNT(*) FROM ' . $this->table . ' WHERE pseudo="' . $pseudo.'"';
		$r = (bool) $this->pdo->query($sql)->fetchColumn();

		return $r;
	}

	public function nameExists($name){
		$sql = 'SELECT COUNT(*) FROM ' . $this->table . ' WHERE name="' . $name.'"';
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

		$sql = "SELECT id, name, firstname, pseudo, birthday, description, kind, city, email, status, img, idTeam, isConnected, lastConnexion, token FROM user WHERE status<>0 AND " . implode(',', $data);
		$query = $this->pdo->query($sql)->fetch();

		if($query === FALSE)
			return false;

		return new user($query);
	}

	public function getTournament(array $infos){
		
		$cols = array_keys($infos);
		$data = [];
		foreach ($cols as $key) {
			$data[$key] = $key.'="'.$infos[$key].'"';
		}
		$sql = "SELECT startDate, endDate, description, playerMin, playerMax, typeTournament, status, nbMatch, idUserCreator, idGameVersion, creationDate FROM ".$this->table." WHERE " . implode(',', $data);
		// var_dump($sql);
		$query = $this->pdo->query($sql)->fetch();
		if($query === FALSE)
			return false;
		return new user(array_filter($query));
	}

	public function getAllNames(){
		$sql = "SELECT name FROM ".$this->table." ORDER BY name";
		$sth = $this->pdo->query($sql);
		return $sth->fetchAll(PDO::FETCH_ASSOC);
	}
}
