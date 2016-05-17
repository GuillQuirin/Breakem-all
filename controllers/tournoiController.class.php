<?php

class tournoiController extends template {

	public function tournoiAction(){
		$v = new view();
		$this->assignConnectedProperties($v);
		

		$args = array(
            't' => FILTER_SANITIZE_STRING
		);
		$filteredinputs = filter_input_array(INPUT_GET, $args);

		// On est dans le cas où on cherche un tournoi !
		if(!empty($filteredinputs)){
			$filteredinputs = array_filter($filteredinputs);
			$link = $filteredinputs['t'];
			$tm = new tournamentManager();
			$matchedTournament = $tm->getTournamentWithLink($link);
			// var_dump($matchedTournament);
			// Si le chercheur renvoie autre chose que false
			if(!!$link){
				$v->assign("css", "detailtournoi");
				$v->assign("js", "detailtournoi");
				$v->assign("title", "Tournoi ".$matchedTournament->getName());
				$v->assign("content", "Tournoi ".$matchedTournament->getName());
				$v->assign("tournoi", $matchedTournament);
				$v->setView("detailtournoiDOM");
				return;
			};
			// Aucun tournoi n'a été trouvé pour l'url reçue
			$v->assign("css", "404");
			$v->assign("js", "404");
			$v->assign("title", "Erreur 404");
	        $v->assign("content", "Erreur 404, <a href='".WEBPATH."'>Retour à l'accueil</a>.");
	        $v->setView("templatefail", "templatefail");
			
		}
		// Pas de get connu reçu, on affiche la page par défaut des tournois
		else{
			$v->assign("css", "tournoi");
			$v->assign("js", "tournoi");
			$v->assign("title", "Tournois");
			$v->assign("content", "Liste principaux tournois jeux vidéos");
			$v->setView("tournoiDOM");
		}
	}

	public function searchAction(){
		$args = array(
            'nom' => FILTER_SANITIZE_STRING,
            'jeu' => FILTER_SANITIZE_STRING,
            'console' => FILTER_SANITIZE_STRING
		);
		$filteredinputs = filter_input_array(INPUT_GET, $args);
		if(!empty($filteredinputs))
			$filteredinputs = array_filter($filteredinputs);

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
			$tournois = $tm->getFilteredTournaments();
			// Si des tournois ont été trouvés
			// var_dump($tournois);
			if(!!$tournois)
				$v->assign("tournois", $tournois);
		}
		// Il y a au moins un filtre 
		else{
			$matchedTournaments = $tm->getFilteredTournaments($filteredinputs);
			// var_dump($matchedTournaments);
			if(!!$matchedTournaments)
				$v->assign("tournois", $matchedTournaments);
		}
		$v->setView("tournamentslist");
	}
}
