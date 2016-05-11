<?php

class tournoiController extends template {

	public function tournoiAction(){
		$v = new view();
		$this->assignConnectedProperties($v);
		$v->assign("css", "tournoi");
		$v->assign("js", "tournoi");
		$v->assign("title", "Tournois");
		$v->assign("content", "Liste principaux tournois jeux vidéos");
		$v->setView("tournoiDOM");
	}

	public function searchAction(){
		$args = array(
            'nom' => FILTER_SANITIZE_STRING,
            'jeu' => FILTER_SANITIZE_STRING,
            'console' => FILTER_SANITIZE_STRING
		);
		$filteredinputs = array_filter(filter_input_array(INPUT_GET, $args));

		$v = new View();
		$v->assign("css", "tournamentslist");
		$v->assign("js", "tournamentslist");
		$v->assign("title", "Tournois");
		$v->assign("content", "Liste des tournois filtrés");
		$this->assignConnectedProperties($v);

		$tm = new tournamentManager();

		// On est dans le cas sans filtre, on va chercher les 10 premiers tournois
		if( count($filteredinputs) == 0){	
			// $tournois contiendra un array rempli d'objets tournament
			$tournois = $tm->getUnstartedTournaments();
			// Si des tournois ont été trouvés
			if(!!$tournois)
				$v->assign("tournois", $tournois);
		}
		// Il y a au moins un filtre 
		else{
			$matchedTournaments = $tm->getFilteredTournaments($filteredinputs);
			var_dump($matchedTournaments);
			if(!!$matchedTournaments)
				$v->assign("tournois", $matchedTournaments);
		}
		$v->setView("tournamentslist");
	}
}
