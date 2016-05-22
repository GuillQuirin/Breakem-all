<?php
/*
*
*/

final class register{
	protected $_id;
	protected $_status;
	protected $_idTeamTournament;
	protected $_idUser;
	protected $_idTournament;

	public function __construct(array $data){
		$this->hydrate($data);
	}

	public function hydrate(array $donnees){
		foreach ($donnees as $key => $value) {
			$method = 'set'.ucfirst($key);
			if ( method_exists($this, $method) ){
				$this->$method($value);
			}
		}
	}

	private function setId($v){
		$this->_id = $v;
	}
	private function setStatus($v){
		$this->_status = $v;
	}
	private function setIdTeamTournament($v){
		$this->_idTeamTournament = $v;
	}
	private function setIdUser($v){
		$this->_idUser = $v;
	}
	private function setIdTournament($v){
		$this->_idTournament = $v;
	}

	public function getId(){return $this->_id;}
	public function getStatus(){return $this->_status;}
	public function getIdTeamTournament(){return $this->_idTeamTournament;}
	public function getIdUser(){return $this->_idUser;}
	public function getIdTournament(){return $this->_idTournament;}

}

/*
*
*/
?>