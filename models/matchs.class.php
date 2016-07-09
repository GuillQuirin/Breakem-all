<?php
/*
* mirroir de la table matchs
*/
final class matchs{
	private $_id;
	private $_idWinningTeam;
	private $_proof;
	private $_idTournament;
	private $_startDate;
	private $_matchNumber;
	private $_teamstournament = [];

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
	public function setIdWinningTeam($v){
		$this->_idWinningTeam = $v;
	}
	public function setProof($v){
		$this->_proof = $v;
	}
	public function setIdTournament($v){
		$this->_idTournament = $v;
	}
	public function setStartDate($v){
		$this->_startDate = $v;
	}
	public function setMatchNumber($v){
		$this->_matchNumber = $v;
	}
	public function addTeamTournament(teamtournament $tt){
		$this->_teamstournament[] = $tt;
	}


	public function getId(){return $this->_id;}
	public function getIdWinningTeam(){return $this->_idWinningTeam;}
	public function getProof(){return $this->_proof;}
	public function getIdTournament(){return $this->_idTournament;}
	public function getStartDate(){return $this->_startDate;}
	public function getMatchNumber(){return $this->_matchNumber;}
	public function gtAllTeamsTournament(){return (count($this->_teamstournament) > 0) ? $this->_teamstournament : false;}

	public function gtWinningTeam(){
		if(!is_numeric($this->_idWinningTeam) || count($this->_teamstournament) == 0)
			return false;
		foreach ($this->_teamstournament as $key => $t) {
			if($t->getId() == $this->getIdWinningTeam())
				return $t;
		}
		return false;
	}

	public function gtLosingTeams(){
		if(!is_numeric($this->_idWinningTeam) || count($this->_teamstournament) == 0)
			return false;
		$losingTeams= [];
		foreach ($this->_teamstournament as $key => $t) {
			if($t->getId() != $this->getIdWinningTeam())
				$losingTeams[] = $t;
		}
		return (count($losingTeams) > 0) ? $losingTeams : false;
	}

}
/*
*
*/