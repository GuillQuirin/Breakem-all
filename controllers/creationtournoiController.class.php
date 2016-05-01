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

	public function getGameTypesAction(){
		$gm = new typegameManager();
		$types = $gm->getAllTypes();
		// print_r($types);
		$data['types'] = [];
		foreach ($types as $key => $arr) {
			$data['types'][] = $arr;
		}
		echo json_encode($data);
	}
	private function isGameTypeNameValid(typegame $tg){
		$gm = new typegameManager();
		$names = $gm->getAllNames();
		$array = [];
		foreach ($names as $key => $arr) {
			$array[] = $arr['name'];
		}
		unset($gm);
		if (in_array($tg->getName(), $array))
			return true;
		return false;
	}
	public function getGamesAction(){
		$args = array(
            'name' => FILTER_SANITIZE_STRING   
		);
		$filteredinputs = filter_input_array(INPUT_POST, $args);
        // $data = [];
		foreach ($args as $key => $value) {
			if(!isset($filteredinputs[$key]))
				$this->echoJSONerror("inputs", "manque: ".$key);
		}
		$tg = new typegame($filteredinputs);
		if(!$this->isGameTypeNameValid($tg))
			$this->echoJSONerror("gametype", "invalid gametype received !");
		
		$gamesManager = new gameManager();
		$gamesFromType = $gamesManager->getGames($tg);
		$data['games'] = [];
		foreach ($gamesFromType as $key => $arr) {
			$data['games'][] = $arr;
		}
		if(count($data['games']) == 0)
			$this->echoJSONerror("games", "no games were found for this particular type");
		echo json_encode($data);
	}
	
}
