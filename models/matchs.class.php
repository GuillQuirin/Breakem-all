<?php
/*
* mirroir de la table matchs
*/
final class matchs{
	private $_id;
	private $_idWinningTeam;
	private $_proof;
	private $_idTournament;
	private $_nameTournament;
	private $_startDate;
	private $_matchNumber;
	private $_teamstournament = [];
	private $_link;
	private $_nomJeu;
	private $_imgJeu;

	public function __construct(array $data){
		$this->hydrate($data);
	}

	public function hydrate(array $donnees){
		foreach ($donnees as $key => $value) {
			$method = 'set'.ucfirst($key);
			if ( method_exists($this, $method) ){
				$this->$method($value);
				$method2 = 'get'.ucfirst($key);
				if(method_exists($this, $method2)){
					$this->_myArr[$key] = $this->$method2();
				}
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
	public function setNameTournament($v){
		$this->_nameTournament = $v;
	}
	public function setStartDate($v){
		$this->_startDate = $v;
	}
	public function setMatchNumber($v){
		$this->_matchNumber = $v;
	}
	public function setNomJeu($v){
		$this->_nomJeu = $v;
	}
	public function setImgJeu($v){
		$this->_imgJeu = $v;
	}
	public function setLink($v){
		$this->_link = $v;
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

	public function gtNameTournament(){
		return $this->_nameTournament;
	}
	public function gtNomJeu(){
		return $this->_nomJeu;
	}

	public function gtImgJeu($upload=false){
		
		if($upload){
			return $this->_imgJeu;
		}
		else{
			if(strlen(trim($this->_imgJeu))>0 && file_exists(getcwd()."/web/img/upload/jeux/".$this->_imgJeu))
				return WEBPATH."/web/img/upload/jeux/".$this->_imgJeu;

			return WEBPATH."/web/img/upload/jeux/default-jeux.png";	
		}
	}

	public function gtLink(){
		return $this->_link;
	}
}
/*
*
*/