<?php
final class tournoi extends basesql{
	private $_id;
	private $_user;
	private $_startDate;
	private $_endDate;
	private $_description;
	private $_playerMin;
	private $_playerMax;
	private $_idGameVersion;
	private $_typeTournament;
	private $_nbMatch;

	public function __construct(array $donnees){
		parent::__construct();
		$this->hydrate($donnees);
	}

	public function hydrate(array $donnees){
		foreach ($donnees as $key => $value) {
			$method = 'set'.ucfirst($key);
			if ( method_exists($this, $method) ){
				$this->$method($value);
			}
		}
	}

	private function setId($v){$this->_id = $v;}
	private function setUser($v){$this->_user = $v;}
	private function setStart_date($v){$this->_startDate = $v;}
	private function setEnd_date($v){$this->_endDate = $v;}
	private function setDescription($v){$this->_description = $v;}
	private function setPlayer_min($v){$this->_playerMin = $v;}
	private function setPlayer_max($v){$this->_playerMax = $v;}
	private function setId_game_version($v){$this->_idGameVersion = $v;}
	private function setType_tournament($v){$this->_typeTournament = $v;}
	private function setNb_match($v){$this->_nbMatch = $v;}

	private function getId(){return $this->_id;}
	private function getUser(){return $this->_user;}
	private function getStart_date(){return $this->_startDate;}
	private function getEnd_date(){return $this->_endDate;}
	private function getDescription(){return $this->_description;}
	private function getPlayer_min(){return $this->_playerMin;}
	private function getPlayer_max(){return $this->_playerMax;}
	private function getId_game_version(){return $this->_idGameVersion;}
	private function getType_tournament(){return $this->_typeTournament;}
	private function getNb_match(){return $this->_nbMatch;}


}