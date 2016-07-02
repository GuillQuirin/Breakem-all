<?php
/*
*
*/
final class tournament{
	// 86400 = nb de secondes/jour
	private $_maxStartDate = 86400 * 90;
	private $_spaceBetweenDates = 86400 * 14;
	private $_endDateWasAutoCreated = false;

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
	protected $_link;
	// Données venant du gameversion (nécessite un inner / outer join)
	protected $_maxPlayer;
	protected $_maxTeam;
	protected $_maxPlayerPerTeam;
	protected $_gvName;
	protected $_gvDescription;
	// Données provenant de game (nécessite un inner / outer join)
	protected $_gameId;
	protected $_gameName;
	protected $_gameDescription;
	protected $_gameImg;
	protected $_gameYear;
	// Ca c'est l'id du gametype
	protected $_gtId;
	// Données provenant de platform (nécessite un inner / outer join)
	protected $_pId;
	protected $_pName;
	protected $_pDescription;
	protected $_pImg;
	// Données provenant de user (nécessite un inner / outer join)
	protected $_userPseudo;
	// Données provenant de register
	protected $_numberRegistered;
	protected $_myArr;
	// Données provenant de matchs
	protected $_matchs = [];

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

	private function setId($v){
		$this->_id = $v;
	}
	public function setStartDate($v, $setEndDate = false){
		$this->_startDate = $v;
		if($setEndDate){
			$this->setEndDate($v+$this->_gtMaxIntervalBetweenDates());
			$this->_endDateWasAutoCreated = true;
		}
			
	}
	public function setEndDate($v){
		if(!$this->_endDateWasAutoCreated)
			$this->_endDate = $v;
	}
	private function setName($v){
		$this->_name = trim($v);
	}
	private function setDescription($v){
		$this->_description = trim($v);
	}
	private function setTypeTournament($v){
		$this->_typeTournament = $v;
	}
	private function setStatus($v){
		$this->_status = $v;
	}
	private function setNbMatch($v){
		$this->_nbMatch = $v;
	}
	private function setIdUserCreator($v){
		$this->_idUserCreator = $v;
	}
	private function setIdGameVersion($v){
		$this->_idGameVersion = $v;
	}
	private function setIdWinningTeam($v){
		$this->_idWinningTeam = $v;
	}
	private function setUrlProof($v){
		$this->_urlProof = $v;
	}
	private function setCreationDate($v){
		$this->_creationDate = $v;
	}
	private function setGuildOnly($v){
		$this->_guildOnly = (int) $v;
	}
	private function setRandomPlayerMix($v){
		$this->_randomPlayerMix = (int) $v;
	}
	private function setLink($v){
		$this->_link = $v;
	}
	// Setters de données issues de gameversion
	private function setMaxPlayer($v){
		$this->_maxPlayer = $v;
	}
	private function setMaxTeam($v){
		$this->_maxTeam = $v;
	}
	private function setMaxPlayerPerTeam($v){
		$this->_maxPlayerPerTeam = $v;
	}
	private function setGvName($v){
		$this->_gvName = $v;
	}
	private function setGvDescription($v){
		$this->_gvDescription = $v;
	}
	// Setters de données issues de game
	private function setGameId($v){
		$this->_gameId = $v;
	}
	private function setGameName($v){
		$this->_gameName = $v;
	}
	private function setGameDescription($v){
		$this->_gameDescription = $v;
	}
	private function setGameImg($v){
		if(strlen(trim($v)) > 0)
			$this->_gameImg = "web/img/".$v;
	}
	private function setGameYear($v){
		$this->_gameYear = $v;
	}
	private function setGtId($v){
		$this->_gtId = $v;
	}
	// Setters de données issues de platform
	private function setPId($v){
		$this->_pId = $v;
	}
	private function setPName($v){
		$this->_pName = $v;
	}
	private function setPDescription($v){
		$this->_pDescription = $v;
	}
	private function setPImg($v){
		if(strlen(trim($v)) > 0)
			$this->_pImg = "web/img/".$v;
	}
	// Setters de données issues de user
	private function setUserPseudo($v){
		$this->_userPseudo = $v;
	}
	// Setters de données issues de register
	private function setNumberRegistered($v){
		$this->_numberRegistered = (int) $v;
	}

	public function addMatch(matchs $m){
		$this->_matchs[] = $m;
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
	public function getLink(){return $this->_link;}
	// Getters de données issues de gameversion
	public function getMaxPlayer(){return $this->_maxPlayer;}
	public function getMaxTeam(){return $this->_maxTeam;}
	public function getMaxPlayerPerTeam(){return $this->_maxPlayerPerTeam;}
	public function getGvName(){return $this->_gvName;}
	public function getGvDescription(){return $this->_gvDescription;}
	// Getters de données issues de game
	public function getGameId(){return $this->_gameId;}
	public function getGameName(){return $this->_gameName;}
	public function getGameDescription(){return $this->_gameDescription;}
	public function getGameImg(){return $this->_gameImg;}
	public function getGameYear(){return $this->_gameYear;}
	public function getGtId(){return $this->_gtId;}
	// Getters de données issues de platform
	public function getPId(){return $this->_pId;}
	public function getPName(){return $this->_pName;}
	public function getPDescription(){return $this->_pDescription;}
	public function getPImg(){return $this->_pImg;}
	// Getters de données issues de user
	public function getUserPseudo(){return $this->_userPseudo;}
	// Getters de données issues de register
	public function getNumberRegistered(){return $this->_numberRegistered ;}
	public function returnAsArr(){
		return $this->_myArr;
	}
	// Getters des matchs
	public function gtAllMatchs(){return (count($this->_matchs) > 0) ? $this->_matchs : false;}


	public function _gtMaxStartDaysInterval(){
		return $this->_maxStartDate;
	}
	public function _gtMaxIntervalBetweenDates(){
		return $this->_spaceBetweenDates;
	}

	public function doesTournamentHaveWinner(){
		return is_numeric($this->getIdWinningTeam());
	}
}
/*
*
*/