<?php
abstract class basesql{

	protected $table;
	protected static $openedConnection = false;
	protected $pdo;
	public $mirrorObject = false;
	protected $columns = [];

	public function __construct(){

		$this->table = get_called_class();
		$this->table = str_replace("Manager", "", $this->table);

		if(self::$openedConnection === false){
			
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

	public function create(){
		// Check afin de savoir qui appelle cette méthode
		$e = new Exception();
		$trace = $e->getTrace();

		// get calling class:
		$calling_class = (isset($trace[1]['class'])) ? $trace[1]['class'] : false;
		// get calling method
		$calling_method = (isset($trace[1]['function'])) ? $trace[1]['function'] : false;


		if(!$calling_class || !$calling_method)
			return false;

		$this->table = get_class($this->mirrorObject);	
		$this->columns = [];
		$object_methods = get_class_methods($this->mirrorObject);

		foreach ($object_methods as $key => $method) {
			if(strpos($method, 'get') !== FALSE){
				$col = lcfirst(str_replace('get', '', $method));
				$this->columns[$col] = ($col==="img") ? $this->mirrorObject->$method(true) : $this->mirrorObject->$method();
			};
		}
		$this->columns = array_filter($this->columns);
		$this->save();
	}

	protected function save(){
		$sql = "INSERT INTO ".$this->table." (".implode(",",array_keys($this->columns)).")
		VALUES (:".implode(",:", array_keys($this->columns)).")";

		$query = $this->pdo->prepare($sql, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));

		foreach($this->columns as $key => $value)
			$data[$key] = $value;

		$query->execute($data);
	}
	
	public function getAllNames(){
		$sql = "SELECT name FROM ".$this->table." ORDER BY name";
		$sth = $this->pdo->query($sql);

		return $sth->fetchAll(PDO::FETCH_ASSOC);
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

}
