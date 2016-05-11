<?php

class creationtournoiController extends template{

	public function __construct(){
		parent::__construct();
		if(!($this->isVisitorConnected())){
			header('Location: ' .WEBPATH);
		}
	}

	public function creationtournoiAction(){
		$v = new view();
		$this->assignConnectedProperties($v);
		$v->assign("css", "creationtournoi");
		$v->assign("js", "creationtournoi");
		$v->assign("title", "Création Tournoi");
		$v->assign("content", "Création Tournoi");
		$v->setView("creationtournoiDOM");
	}
	// On retourne ici tous les types de jeux (moba/fps/...)
	public function getGameTypesAction(){
		$gm = new typegameManager();
		$typesObj = $gm->getAllTypes();
		$data['types'] = [];
		foreach ($typesObj as $key => $obj) {
			$arr = [];
			$arr['name'] = $obj->getName();
			$arr['img'] = $obj->getImg();
			$arr['description'] = $obj->getDescription();
			$data['types'][] = $arr;
		}
		echo json_encode($data);
		return;
	}
	// On retourne ici les jeux disponibles pour le type de jeu sélectionné
	public function getGamesAction(){
		$args = array(
            'name' => FILTER_SANITIZE_STRING   
		);
		$filteredinputs = filter_input_array(INPUT_POST, $args);
		foreach ($args as $key => $value) {
			if(!isset($filteredinputs[$key]))
				$this->echoJSONerror("inputs", "manque: ".$key);
		}
		$tg = new typegame($filteredinputs);
		if(!$this->isPostNameValid('typegameManager', $tg->getName()))
			$this->echoJSONerror("gametype", "invalid gametype received !");
		
		$gamesManager = new gameManager();
		$gamesFromType = $gamesManager->getGames($tg);
		$data['games'] = [];
		foreach ($gamesFromType as $key => $gameObj) {
			$curData = [];
			$curData['name'] = $gameObj->getName();
			$curData['description'] = $gameObj->getDescription();
			$curData['img'] = $gameObj->getImg();
			$data['games'][] = $curData;
		}
		if(count($data['games']) == 0)
			$this->echoJSONerror("games", "no games were found for this particular type");
		$_SESSION['gametypename'] = $tg->getName();
		echo json_encode($data);
		return;
	}
	// On retourne ici les plateformes disponibles pour le jeu sélectionné
	public function getConsolesAction(){
		if(isset($_SESSION['gametypename'])){
			$args = array(
	            'name' => FILTER_SANITIZE_STRING   
			);
			$filteredinputs = filter_input_array(INPUT_POST, $args);
			foreach ($args as $key => $value) {
				if(!isset($filteredinputs[$key]))
					$this->echoJSONerror("inputs", "manque: ".$key);
			}
			$g = new game($filteredinputs);
			if(!$this->isPostNameValid('gameManager', $g->getName()))
				$this->echoJSONerror("game", "unknown game received !");
			
			$gvManager = new gameversionManager();
			$platforms = $gvManager->getAvailablePlatforms($g);
			if(!$platforms)
				$this->echoJSONerror("db", "query issue");
			$data['platforms'] = [];
			foreach ($platforms as $key => $platformObj) {
				$curData = [];
				$curData['name'] = $platformObj->getName();
				$curData['description'] = $platformObj->getDescription();
				$curData['img'] = $platformObj->getImg();
				$data['platforms'][] = $curData;
			}
			if(count($data['platforms']) == 0)
				$this->echoJSONerror("platforms", "no platforms available for this game");
			$_SESSION['gamename'] = $g->getName();
			echo json_encode($data);
			return;
		}
		die("Choisissez d'abord le type de jeu !");
	}	
	public function getVersionsAction(){
		// On vérifie que les étapes précédentes ont été validées
			// On se basera sur ces valeurs pour l'enregistrement
		if(isset($_SESSION['gamename'])){
			// On sécure la seule donnée à traiter, le reste ne sera pas traiter du tout
			$args = array(
	            'name' => FILTER_SANITIZE_STRING   
			);
			$filteredinputs = filter_input_array(INPUT_POST, $args);
			foreach ($args as $key => $value) {
				if(!isset($filteredinputs[$key]))
					$this->echoJSONerror("inputs", "manque: ".$key);
			}
			$platform = new platform($filteredinputs);

			if(!$this->isPostNameValid('platformManager', $platform->getName()))
				$this->echoJSONerror("platform", "unknown platform received !");

			$gvManager = new gameversionManager();
			$gameversions = $gvManager->getAvailableVersions($platform);
			if(!$gameversions)
				$this->echoJSONerror("db", "query issue");
			$data['versions'] = [];
			foreach ($gameversions as $key => $versionObj) {
				$curData = [];
				$curData['name'] = $versionObj->getName();
				$curData['description'] = $versionObj->getDescription();
				$curData['maxPlayer'] = $versionObj->getMaxPlayer();
				$curData['minPlayer'] = $versionObj->getMinPlayer();
				$curData['maxTeam'] = $versionObj->getMaxTeam();
				$curData['minTeam'] = $versionObj->getMinTeam();
				$curData['maxPlayerPerTeam'] = $versionObj->getMaxPlayerPerTeam();
				$curData['minPlayerPerTeam'] = $versionObj->getMinPlayerPerTeam();
				$data['versions'][] = $curData;
			}
			if(count($data['versions']) == 0)
				$this->echoJSONerror("gameversions", "no versions available for this console");
			$_SESSION['platformname'] = $platform->getName();
			$_SESSION['availableGV_ids'] = [];
			$i = 0;
			foreach ($gameversions as $key => $gvObj) {
				$_SESSION['availableGV_ids']['id'.$i] = $gvObj->getId();
				++$i;
			}
			echo json_encode($data);
			return;
		}
		die("Choisis peut être une console avant ...");
	}
	public function getFinalStepAction(){
		if(isset($_SESSION['platformname'])){
			$args = array(
	            'name' => FILTER_SANITIZE_STRING,
	            'startDate' => FILTER_SANITIZE_STRING,
	            'endDate' => FILTER_SANITIZE_STRING,
	            'description' => FILTER_SANITIZE_STRING,
	            'randomPlayerMix' => FILTER_VALIDATE_BOOLEAN,
	            'guildOnly' => FILTER_VALIDATE_BOOLEAN,
            	'gversionName' => FILTER_SANITIZE_STRING,
	            'gversionDescription' => FILTER_SANITIZE_STRING,
	            'gversionMaxPlayer' => FILTER_VALIDATE_INT,
	            'gversionMinPlayer' => FILTER_VALIDATE_INT,
	            'gversionMaxTeam' => FILTER_VALIDATE_INT,
	            'gversionMinTeam' => FILTER_VALIDATE_INT,
	            'gversionMaxPlayerPerTeam' => FILTER_VALIDATE_INT
			);
			$filteredinputs = filter_input_array(INPUT_POST, $args);
			// print_r($filteredinputs);
			foreach ($args as $key => $value) {
				if(!isset($filteredinputs[$key]))
					$this->echoJSONerror("inputs", "manque: ".$key);
			}
			$tournoi = new tournoi($filteredinputs);
			$this->validTournoiData($tournoi);
			$receivedVersion = new gameversion(
				[
					'name' => $filteredinputs['gversionName'],
					'description' => $filteredinputs['gversionDescription'],
					'maxPlayer' => $filteredinputs['gversionMaxPlayer'],
					'maxTeam' => $filteredinputs['gversionMaxTeam'],
					'maxPlayerPerTeam' => $filteredinputs['gversionMaxPlayerPerTeam']
				]
			);
			//  Si la version est validée $receivedVers contient toutes les infos de la version (id, idGame, etc..)
			$receivedVersion = $this->getDbVersionIfExists($receivedVersion);
			if(!!$receivedVersion){
				// tout est bon
				// 		--> On peut informer le client qu'il peut proceder à la creation
				// 		--> prochaine etape : petit récapitulatif avant validation et insert
				$_SESSION['selectedGameVersion'] = $receivedVersion->getId();
				$_SESSION['selectedTournamentName'] = $tournoi->getName();
				$_SESSION['selectedTournamentDescription'] = $tournoi->getDescription();
				$_SESSION['selectedTournamentStartDate'] = $tournoi->getStartDate();
				$_SESSION['selectedTournamentEndDate'] = $tournoi->getEndDate();
				$_SESSION['selectedTournamentGuild'] = $tournoi->getGuildOnly();
				$_SESSION['selectedTournamentRand'] = $tournoi->getRandomPlayerMix();
				$data = [];
				$data['name'] = $tournoi->getName();
				$data['description'] = $tournoi->getDescription();
				$data['dateDebut'] = $tournoi->getStartDate();
				$data['dateFin'] = $tournoi->getEndDate();
				$data['guildTeams'] = $tournoi->getGuildOnly();
				$data['randTeams'] = $tournoi->getRandomPlayerMix();
				$data['jeu'] = $_SESSION['gamename'];
				$data['console'] = $_SESSION['platformname'];
				$data['versionName'] = $receivedVersion->getName();
				$data['versionDescription'] = $receivedVersion->getDescription();
				$data['maxPlayer'] = $receivedVersion->getMaxPlayer();
				$data['minPlayer'] = $receivedVersion->getMinPlayer();
				$data['maxTeam'] = $receivedVersion->getMaxTeam();
				$data['minTeam'] = $receivedVersion->getMinTeam();
				$data['maxPlayerPerTeam'] = $receivedVersion->getMaxPlayerPerTeam();
				echo json_encode($data);
				return;
			}
			$this->echoJSONerror("version", "Ta version de jeu est inconnue au bataillon");
		}
		die("Choisis peut être une console avant ...");
	}

	
	// Cette fonction servira à aller chercher tous les noms des consoles / games / typegames pour les comparer de façon secure à une donnée reçue
	// 	Le premier parametre servira à savoir dans quelle table on veut aller recuperer les 
	//		noms
	private function isPostNameValid($className, $nameToCheck){
		$manager = new $className();
		$names = $manager->getAllNames();
		$array =  [];
		foreach ($names as $key => $arr) {
			$array[] = $arr['name'];
		}
		unset($manager);
		if (in_array($nameToCheck, $array))
			return true;
		return false;
	}
	// Cette fonction sert à comparer la version de jeu sélectionée avec les existantes, en accord avec les précédents choix
	// 	du client et ainsi vérifier l'intégrité de ses posts 
	//  		--> Si tout va bien la fonction renvoie la version full de la base correspondant à la version
	// 			--> Si non : elle renvoie false
	private function getDbVersionIfExists(gameversion $gv){
		if(!isset($_SESSION['availableGV_ids']))
			die("Tu n'as pas choisi ta console !");
		$gvm = new gameversionManager();
		$validVersions = $gvm->getChoosableVersions();
		foreach ($validVersions as $key => $obj) {
			if ($gv->isEqualTo($obj))
				return $obj;
		}
		return false;
	}
	private function validTournoiData(tournoi $t){
		if(!(validateDate($t->getStartDate(), 'd/m/Y')))
			$this->echoJSONerror("dateDebut", "C'est quoi cette date ?");
		if(!(validateDate($t->getEndDate(), 'd/m/Y')))
			$this->echoJSONerror("dateFin", "C'est quoi cette date ?");

		$d1 = DateTime::createFromFormat('d/m/Y', $t->getStartDate());
		$d2 = DateTime::createFromFormat('d/m/Y', $t->getEndDate());

		$baseDate= DateTime::createFromFormat('d/m/Y', date('d/m/Y'));
		$baseDateTime = $baseDate->getTimestamp();
		if($d1->getTimestamp() < $baseDateTime)
			$this->echoJSONerror("dateDebut", "La date de debut doit etre dans le futur");
		if((int) date('G') > 12 && $d1->getTimestamp() === $baseDateTime)
			$this->echoJSONerror("dateDebut", "Il n'est plus possible de creer de tournois pour le jour meme passe 18h");
		if($d2->getTimestamp() < $d1->getTimestamp())
			$this->echoJSONerror("dateFin", "La date de fin doit etre superieure a celle de debut");
		if($d2->getTimestamp() - $d1->getTimestamp() < 86400)
			$this->echoJSONerror("dateFin", "Pour limiter le nombre de tournois par compte cree et par jour il est necessaire que le tournoi finisse au moins un jour apres son debut");
		$deuxSemaines = 86400 * 14;
		$uneSemaine = 86400 * 7;
		if($d1->getTimestamp() - time() > $deuxSemaines)
			$this->echoJSONerror("dateDebut", "Le tournoi doit commencer avant 14 jours");
		if($d2->getTimestamp() - $d1->getTimestamp() > $uneSemaine)
			$this->echoJSONerror("dateFin", "Le tournoi ne doit pas durer plus de 7 jours");

		if(preg_match("/[^a-z0-9 éàôûîêçùèâ]/i", $t->getName()))
			$this->echoJSONerror("nom", "Le nom de votre tournoi contient des caracteres speciaux !");
		if(!empty(trim($t->getDescription()))){
			if(preg_match("/[^a-z0-9 ,\.=\!éàôûîêçùèâ@\(\)\?]/i", $t->getDescription()))
				$this->echoJSONerror("descripiton", "La description de votre tournoi contient des caracteres speciaux !");
			if(strlen($t->getDescription()) > 199 || $t->getDescription() < 15)
				$this->echoJSONerror("descripiton", "La description, lorsque utilisée, doit faire entre 15 et 199 caracteres");
		}
			

		if($t->getGuildOnly() === 1 && $t->getRandomPlayerMix() === 1)
			$this->echoJSONerror("equipe", "Les équipes de guilde ne peuvent etre faconnees aleatoierement");
	}
}
