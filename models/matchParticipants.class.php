<?php
/*
* mirroir de la table matchParticipants
*/
final class matchParticipants{
	private $_id;
	private $_idMatch;
	private $_idTeamTournament;

	public function __construct(array $data){
		$this->hydrate($data);
	}

	public function hydrate(array $donnees){
		foreach ($donnees as $key => $value) {
			$method = 'set'.ucfirst($key);
			if ( method_exists($this, $method) ){
				$this->$method($value);
				$method2 = 'get'.ucfirst($key);
				$this->_myArr[$key] = $this->$method2();
			}
		}
	}

	public function setId($v){
		$this->_id = $v;
	}
	public function setIdMatch($v){
		$this->_idMatch = $v;
	}
	public function setIdTeamTournament($v){
		$this->_idTeamTournament = $v;
	}

	public function getId(){return $this->_id;}
	public function getIdMatch(){return $this->_idMatch;}
	public function getIdTeamTournament(){return $this->_idTeamTournament;}


}
/*
*
*/