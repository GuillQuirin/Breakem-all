<?php
final class tournoi{
	protected $_id;
	protected $_startDate;
	protected $_endDate;
	protected $_name;
	protected $_description;
	protected $_typeTournament;
	protected $_status;
	protected $_nbMatch;
	protected $_idUserCreator;
	protected $_idGameVersion;
	protected $_idWinningTeam;
	protected $_urlProof;
	protected $_creationDate;
	protected $_guildOnly;
	protected $_randomPlayerMix;

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
	private function setStartDate($v){$this->_startDate = $v;}
	private function setEndDate($v){$this->_endDate = $v;}
	private function setName($v){$this->_name = trim($v);}
	private function setDescription($v){$this->_description = trim($v);}
	private function setTypeTournament($v){$this->_typeTournament = $v;}
	private function setStatus($v){$this->_status = $v;}
	private function setNbMatch($v){$this->_nbMatch = $v;}
	private function setIdUserCreator($v){$this->_idUserCreator = $v;}
	private function setIdGameVersion($v){$this->_idGameVersion = $v;}
	private function setIdWinningTeam($v){$this->_idWinningTeam = $v;}
	private function setUrlProof($v){$this->_urlProof = $v;}
	private function setCreationDate($v){$this->_creationDate = $v;}
	private function setGuildOnly($v){
		$this->_guildOnly = (int) $v;
	}
	private function setRandomPlayerMix($v){
		$this->_randomPlayerMix = (int) $v;
	}



	public function getId(){return $this->_id;}
	public function getStartDate(){return $this->_startDate;}
	public function getEndDate(){return $this->_endDate;}
	public function getName(){return $this->_name;}
	public function getDescription(){return $this->_description;}
	public function getTypeTournament(){return $this->_typeTournament;}
	public function getStatus(){return $this->_status;}
	public function getNbMatch(){return $this->_nbMatch;}
	public function getIdUserCreator(){return $this->_idUserCreator;}
	public function getIdGameVersion(){return $this->_idGameVersion;}
	public function getIdWinningTeam(){return $this->_idWinningTeam;}
	public function getUrlProof(){return $this->_urlProof;}
	public function getCreationDate(){return $this->_creationDate;}
	public function getGuildOnly(){return $this->_guildOnly;}
	public function getRandomPlayerMix(){return $this->_randomPlayerMix;}

}