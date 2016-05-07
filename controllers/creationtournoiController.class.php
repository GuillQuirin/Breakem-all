<?php

class creationtournoiController extends template{

	public function __construct(){
		parent::__construct();
		if(!($this->isVisitorConnected())){
			header('Location: ' .WEBPATH);
		}
	}

	public function creationtournoiAction(){
		$v = new View();
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
		exit;
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
			echo json_encode($data);
			exit;
		}
		die("Choisissez peut être une console avant ...");
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
}
