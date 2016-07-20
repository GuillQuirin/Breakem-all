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
	protected $_numberRegistered = false;
	protected $_registeredList = [];

	protected $_myArr;
	// Données provenant de matchs
	protected $_matchs = [];
	protected $_minIdMatch = PHP_INT_MAX;
	protected $_biggestMatchNumber = 0;
	// Données provenant de teamtournament
	protected $_fullteams = [];
	protected $_freeteams = [];
	protected $_minIdTeam = PHP_INT_MAX;

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

	/*SETTERS*/

	private function setId($v){
		if((int) $v > 0)
			$this->_id = (int) $v;
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
		$this->_name = strip_tags(trim($v));
	}
	private function setDescription($v){
		$this->_description = strip_tags((trim($v)));
	}
	private function setTypeTournament($v){
		$this->_typeTournament = (int) $v;
	}
	private function setStatus($v){
		$this->_status = (int) $v;
	}
	private function setNbMatch($v){
		if((int) $v > 0)
			$this->_nbMatch = (int) $v;
	}
	private function setIdUserCreator($v){
		if((int) $v > 0)
			$this->_idUserCreator = (int) $v;
	}
	private function setIdGameVersion($v){
		if((int) $v > 0)
			$this->_idGameVersion = (int) $v;
	}
	private function setIdWinningTeam($v){
		if((int) $v > 0)
			$this->_idWinningTeam = (int) $v;
	}
	private function setUrlProof($v){
		$this->_urlProof = strip_tags(trim($v));
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
		$this->_link = strip_tags(trim($v));
	}

	// Setters de données issues de gameversion
	private function setMaxPlayer($v){
		if((int) $v > 0)
			$this->_maxPlayer = (int) $v;
	}
	private function setMaxTeam($v){
		if((int) $v > 0)
			$this->_maxTeam = (int) $v;
	}
	private function setMaxPlayerPerTeam($v){
		if((int) $v > 0)
			$this->_maxPlayerPerTeam = (int) $v;
	}
	private function setGvName($v){
		$this->_gvName = strip_tags(trim($v));
	}
	private function setGvDescription($v){
		$this->_gvDescription = strip_tags(trim($v));
	}
	
	// Setters de données issues de game
	private function setGameId($v){
		if((int) $v > 0)
			$this->_gameId = (int) $v;
	}
	private function setGameName($v){
		$this->_gameName = strip_tags(trim($v));
	}
	private function setGameDescription($v){
		$this->_gameDescription = strip_tags(trim($v));
	}
	private function setGameImg($v){
		$this->_gameImg = strip_tags(trim($v));
	}
	private function setGameYear($v){
		$this->_gameYear = strip_tags(trim($v));
	}
	private function setGtId($v){
		if((int) $v > 0)
			$this->_gtId = (int) $v;
	}

	// Setters de données issues de platform
	private function setPId($v){
		if((int) $v > 0)
			$this->_pId = (int) $v;
	}
	private function setPName($v){
		$this->_pName = strip_tags(trim($v));
	}
	private function setPDescription($v){
		$this->_pDescription = strip_tags(trim($v));
	}
	private function setPImg($v){
		$this->_pImg = strip_tags(trim($v));
	}
	
	// Setters de données issues de user
	private function setUserPseudo($v){
		$this->_userPseudo = strip_tags(trim($v));
	}
	
	// Setters de données issues de register
	private function setNumberRegistered($v){
		$this->_numberRegistered = (int) $v;
	}
	public function addRegisteredUser(register $usr){
		$this->_registeredList[] = $usr;
	}

	public function addMatch(matchs $m){
		$this->_matchs[] = $m;
		if((int) $m->getId() < $this->_minIdMatch)
			$this->_minIdMatch = (int) $m->getId();
		if((int) $m->getMatchNumber() > $this->_biggestMatchNumber)
			$this->_biggestMatchNumber = (int) $m->getMatchNumber();
	}

	public function addFreeTeam(teamtournament $tt){
		$this->_freeteams[] = $tt;
		if((int) $tt->getId() < $this->_minIdTeam)
			$this->_minIdTeam = (int) $tt->getId();
	}
	public function addFullTeam(teamtournament $tt){
		$this->_fullteams[] = $tt;
		if((int) $tt->getId() < $this->_minIdTeam)
			$this->_minIdTeam = (int) $tt->getId();
	}


	/*GETTERS*/
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
	public function getGameImg($upload=false){
		if($upload){
			return $this->_gameImg;
		}
		else{
			if(strlen(trim($this->_gameImg))>0 && file_exists(getcwd()."/web/img/upload/jeux/".$this->_gameImg))
				return WEBPATH."/web/img/upload/jeux/".$this->_gameImg;

			return WEBPATH."/web/img/upload/jeux/default-jeux.png";	
		}
	}
	public function getGameYear(){return $this->_gameYear;}
	public function getGtId(){return $this->_gtId;}
	
	// Getters de données issues de platform
	public function getPId(){return $this->_pId;}
	public function getPName(){return $this->_pName;}
	public function getPDescription(){return $this->_pDescription;}
	public function getPImg($upload=false){
		if($upload){
			return $this->_pImg;
		}
		else{
			if(strlen(trim($this->_pImg))>0 && file_exists(getcwd()."/web/img/upload/platform/".$this->_pImg))
				return WEBPATH."/web/img/upload/platform/".$this->_pImg;

			return WEBPATH."/web/img/upload/platform/default-platform.png";	
		}
	}
	
	// Getters de données issues de user
	public function getUserPseudo(){return $this->_userPseudo;}
	
	// Getters de données issues de register
	public function getNumberRegistered(){return (!!$this->_numberRegistered) ? $this->_numberRegistered : count($this->gtAllRegistered());}
	public function gtAllRegistered(){return $this->_registeredList;}
	public function returnAsArr(){return $this->_myArr;}

	// Getters des matchs
	public function gtAllMatchs(){return (count($this->_matchs) > 0) ? $this->_matchs : false;}
	public function gtPublicMatchIdToPrint(matchs $m){
		return ((int) $m->getId() - $this->_minIdMatch + 1);
	}
	public function gtRevertPublicMatchId(matchs $m){
		return ((int) $m->getId() + $this->_minIdMatch - 1);
	}
	public function gtBiggestMatchNumber(){
		return $this->_biggestMatchNumber;
	}


	// Getters des teamtournament
	public function gtFreeTeams(){return $this->_freeteams;}
	public function gtFullTeams(){return $this->_fullteams;}
	public function gtAllTeams(){return array_merge($this->gtFreeTeams(), $this->gtFullTeams());}
	public function gtParticipatingTeams(){
		$minimumRequiredMemberNumbersTeam = [];
		foreach ($this->gtAllTeams() as $key => $team) {
			if((int) $team->getTakenPlaces() >= ($this->getMaxPlayerPerTeam()/2))
				$minimumRequiredMemberNumbersTeam[] = $team;
		}
		return $minimumRequiredMemberNumbersTeam;
		// var_dump($minimumRequiredMemberNumbersTeam);
	}
	public function gtMatchesSortedByRank(){
		$sortedMatches = [];
		$min = PHP_INT_MAX;
		$max = 0;
		foreach ($this->gtAllMatchs() as $key => $match) {
			$currentMatchRank = (int) $match->getMatchNumber();
			$sortedMatches[$currentMatchRank][] = $match;
		}
		return $sortedMatches;
	}
	public function gtPublicTeamIdToPrint(teamtournament $tt){
		return ((int) $tt->getId() - $this->_minIdTeam + 1);
	}
	public function gtRevertPublicTeamId(teamtournament $tt){
		return ((int) $tt->getId() + $this->_minIdTeam - 1);
	}

	public function _gtMaxStartDaysInterval(){
		return $this->_maxStartDate;
	}
	public function _gtMaxIntervalBetweenDates(){
		return $this->_spaceBetweenDates;
	}

	public function doesTournamentHaveWinner(){
		return is_numeric($this->getIdWinningTeam());
	}
	public function gtWinningTeam(){
		foreach ($this->gtAllTeams() as $key => $team) {
			if($team->getId() == $this->getIdWinningTeam())
				return $team;
		}
		return false;
	}


	public function resetUsersMatchsTeamsDatas(){
		$this->_numberRegistered = false;
		$this->_registeredList = [];

		$this->_myArr = [];
		// Données provenant de matchs
		$this->_matchs = [];
		$this->_minIdMatch = PHP_INT_MAX;
		$this->_biggestMatchNumber = 0;
		// Données provenant de teamtournament
		$this->_fullteams = [];
		$this->_freeteams = [];
		$this->_minIdTeam = PHP_INT_MAX;
	}

	public function gtNumberOfRoundsPlanned(){
		$playingTeams = count($this->gtParticipatingTeams());

		$roundNumber = 0;
		while( $playingTeams > 1){
			if( $playingTeams % 2 === 0 ){
				$playingTeams = $playingTeams/2;
			}
			else{
				$playingTeams--;
			}
			$roundNumber++;
		}
		return $roundNumber;
	}

	public function isUserRegistered(user $u){
		foreach ($this->gtAllTeams() as $key => $team) {
			foreach ($team->getUsers() as $key => $tUser) {
				if($tUser->getPseudo() == $u->getPseudo())
					return true;
			}
		}
		return false;
	}
}
/*
*
*/