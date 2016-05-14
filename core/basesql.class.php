<?php
class basesql{

	protected $table;
	protected static $openedConnection = false;
	protected $pdo;
	protected $columns = [];

	public function __construct(){
		$this->table = get_called_class();
		$this->table = str_replace("Manager", "", $this->table);

		if( self::$openedConnection === false){
			$dsn = "mysql:dbname=".DBNAME.";host=".DBHOST;
			try{
				self::$openedConnection = new PDO($dsn,DBUSER,DBPWD, array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES 'utf8'"));
			}catch(Exception $e){
				die("Erreur SQL : ".$e->getMessage());
			}
		}
		$this->pdo = self::$openedConnection;
	
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
		$sql = 'SELECT COUNT(*) FROM user WHERE pseudo="' . $pseudo.'"';
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

		$sql = "SELECT id, name, firstname, pseudo, birthday, description, kind, city, email, status, img, idTeam, isConnected, lastConnexion, rss, authorize_mail_contact, token FROM user WHERE status<>0 AND " . implode(',', $data);
		$query = $this->pdo->query($sql)->fetch();

		if($query === FALSE)
			return false;

		return new user($query);
	}

	public function getTeam(array $infos){
		//tab[name]='Test'
		$cols = array_keys($infos);
		$data = [];
		$where = '';

		foreach ($cols as $key ){

			//On met la ligne de $infos dans le tableau $data
			$data[$key] = $infos[$key];

			//WHERE name = :name AND col2 = :col2 etc.....
			$where .= $key.'=:'.$key.'';

			//Tant qu'on est pas à la fin du tableau, on rajoute un AND à la requete SQL
			if(end($cols)!==$key)
				$where.= ' AND ';
		}

		$sql = "SELECT id, name, img, slogan, description 
					FROM team 
					WHERE ".$where;
		// var_dump($sql);
		// exit;

		$query = $this->pdo->prepare($sql, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));	
		$query->execute($data);	
		
		//fetch -> retourne une ligne de la BDD
		//fetchAll -> retourne plusieurs de la BDD
		$r = $query->fetch(PDO::FETCH_ASSOC);

		if($query === FALSE)
			return false;

		return new team($r);
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

	// LAISSER LE NOM DE LA TBALE EN DYNAMIQUE SVP
	public function getAllNames(){
		$sql = "SELECT name FROM ".$this->table." ORDER BY name";
		$sth = $this->pdo->query($sql);
		return $sth->fetchAll(PDO::FETCH_ASSOC);
	}
}
