<?php
/*
*
*/
// On ne peut pas instancier cette classe !
// 	Cette classe est faite dans le seul but de définir des méthodes communes à plusieurs managers (les classes filles fde celle ci, genre tournoiManager) de page 
abstract class sqlManager{

	private $table; 
	private $_db;
	private $_columns = [];

	public function __construct(){
		$this->table = get_called_class();
		try{
			$this->_db = new PDO('mysql:host='.DBHOST.';dbname='.DBNAME.';', DBUSER, DBMDP, [PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION]);
		}catch(Exception $e){
			die("Erreur SQL : " . $e->getMessage());
		}

		$all_vars = get_object_vars($this);
		$class_vars = get_class_vars(get_class());
		$this->_columns = array_keys(array_diff_key($all_vars, $class_vars));

		var_dump($this->_columns);
	}
	
}
/*
*
*/