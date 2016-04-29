<?php
final class tournoi{
	protected $_id;
	protected $_user;
	protected $_startDate;
	protected $_endDate;
	protected $_description;
	protected $_playerMin;
	protected $_playerMax;
	protected $_idGameVersion;
	protected $_typeTournament;
	protected $_nbMatch;

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

	private function setId($v){$this->_id = $v;}
	private function setTournament($v){$this->_user = $v;}
	private function setStart_date($v){$this->_startDate = $v;}
	private function setEnd_date($v){$this->_endDate = $v;}
	private function setDescription($v){$this->_description = $v;}
	private function setPlayer_min($v){$this->_playerMin = $v;}
	private function setPlayer_max($v){$this->_playerMax = $v;}
	private function setId_game_version($v){$this->_idGameVersion = $v;}
	private function setType_tournament($v){$this->_typeTournament = $v;}
	private function setNb_match($v){$this->_nbMatch = $v;}

	public function getId(){return $this->_id;}
	public function getTournament(){return $this->_user;}
	public function getStart_date(){return $this->_startDate;}
	public function getEnd_date(){return $this->_endDate;}
	public function getDescription(){return $this->_description;}
	public function getPlayer_min(){return $this->_playerMin;}
	public function getPlayer_max(){return $this->_playerMax;}
	public function getId_game_version(){return $this->_idGameVersion;}
	public function getType_tournament(){return $this->_typeTournament;}
	public function getNb_match(){return $this->_nbMatch;}


}