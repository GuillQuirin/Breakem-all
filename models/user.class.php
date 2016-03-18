<?php 

class user extends basesql{
	public function __construct(){
		parent::__construct();
	}

	public function pseudoExists($pseudo){
		$sql = 'SELECT COUNT(*) FROM ' . $this->table . ' WHERE pseudo=' . $pseudo; 
		$r = (bool) $this->pdo->execute($sql)->fetchColumn();

		return $r;
	}
	public function emailExists($email){		
		$sql = 'SELECT COUNT(*) FROM ' . $this->table . ' WHERE email=' . $email; 
		$r = (bool) $this->pdo->execute($sql)->fetchColumn();

		return $r;
	}

}