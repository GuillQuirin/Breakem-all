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
			// Si le chercheur renvoie autre chose que false
			if(!!$link && is_bool(strpos($link, 'null')) && $matchedTournament !== false){
				$v->assign("css", "detailtournoi");
				$v->assign("js", "detailtournoi");
				$v->assign("title", "Tournoi ".$matchedTournament->getName());
				$v->assign("content", "Tournoi ".$matchedTournament->getName());
				$v->assign("tournoi", $matchedTournament);

				// Recuperer tous les participants
				$rm = new registerManager();
				$allRegistered = $rm->getTournamentParticipants($matchedTournament);
				// Ne les envoyer ds la vue s'il y en a
				if(!!$allRegistered)
					$v->assign("allRegistered", $allRegistered);

				// Recuperer toutes les équipes avec le nombre de places prises
				$ttm = new teamtournamentManager();
				$allTournTeams = $ttm->getTournamentTeams($matchedTournament);
				if(!!$allTournTeams){
					$freeTeams = [];
					$fullTeams = [];
					foreach ($allTournTeams as $key => $teamtournament) {
						if($teamtournament->getTakenPlaces() < $matchedTournament->getMaxPlayerPerTeam())
							$freeTeams[] = $teamtournament;
						else{
							$usersInTeam = $rm->getTeamTournamentUsers($teamtournament);
							$teamtournament->addUsers($usersInTeam);
							$fullTeams[] = $teamtournament;
						}
					}
					$v->assign("freeTeams", $freeTeams);
					$v->assign("fullTeams", $fullTeams);
				};
				$userAlrdyRegistered = $rm->isUserRegisteredForTournament($matchedTournament, $this->getConnectedUser());
				// /!\ LORSQUE L'USER N'EST PAS INSCRIT ON SFAIT $userAlrdyRegistered === FALSE DONC CETTE VARIABLE SERA SUPPRIMEE PAR LE FILTER ARRAY DS LE extract() de view.class
				$v->assign("userAlrdyRegistered", $userAlrdyRegistered);
				$v->assign("_user", $this->getConnectedUser());
				unset($ttm, $tm, $rm);
				$v->setView("detailtournoiDOM");
				return;
			};
			unset($tm);
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
	public function registerAction(){
		$v = new view();
		$this->assignConnectedProperties($v);
		

		$args = array(
            't' => FILTER_SANITIZE_STRING,
            'sJeton' => FILTER_SANITIZE_STRING
		);
		$filteredinputs = filter_input_array(INPUT_GET, $args);

		// On est dans le cas où on cherche un tournoi !
		if(!empty($filteredinputs)){
			$filteredinputs = array_filter($filteredinputs);
			$link = $filteredinputs['t'];
			$tm = new tournamentManager();
			$matchedTournament = $tm->getTournamentWithLink($link);
			// Si le chercheur renvoie autre chose que false
			if(!!$link && is_bool(strpos($link, 'null')) && $matchedTournament !== false){
				echo "TOURNOI TROUVE \n";
				$rm = new registerManager();
				if(canUserRegisterToTournament($this->getConnectedUser(), $matchedTournament))
					echo "USER ELIGIBLE ! \n";
				else{
					unset($rm);
					$this->echoJSONerror('tournoi', 'vous ne pouvez pas vous inscrire dans ce tournoi');
				}
			};
			unset($tm);
		}
		// Pas de get connu reçu, on affiche la page par défaut des tournois
		else{
			$this->echoJSONerror('tournoi', 'tournoi non-existant');
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
