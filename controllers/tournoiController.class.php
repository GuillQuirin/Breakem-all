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

				// Recuperer tous les participants
				$rm = new registerManager();
				$allRegistered = $rm->getTournamentParticipants($matchedTournament);
				// Ne les envoyer ds la vue s'il y en a

				if(!!$allRegistered){
					$users = [];
					$um = new userManager();
					foreach ($allRegistered as $key => $registered) {
						$u = new user([]);
						$u->setPseudo($registered->getPseudo());
						$u = $um->userByPseudoInstance($u);
						$stats = $um->getTotalMatchsAndVictoriesByPseudo($u);
						if(is_array($stats)){
							$u->setTotalMatchs($stats["totalMatchs"]);
							$u->setTotalWonMatchs($stats["totalWonMatchs"]);
						}
						$users[] = $u;
					}
					if(count($users) > 0)
						$v->assign("allRegistered", $users);
				}
					

				// Recuperer toutes les équipes avec le nombre de places prises
				$ttm = new teamtournamentManager();
				$allTournTeams = $ttm->getTournamentTeams($matchedTournament);
				if(!!$allTournTeams){
					$freeTeams = [];
					$fullTeams = [];
					foreach ($allTournTeams as $key => $teamtournament) {
						$usersInTeam = $rm->getTeamTournamentUsers($teamtournament);
						if(is_array($usersInTeam))
							$teamtournament->addUsers($usersInTeam);
						if($teamtournament->getTakenPlaces() < $matchedTournament->getMaxPlayerPerTeam()){
							$matchedTournament->addFreeTeam($teamtournament);
							$freeTeams[] = $teamtournament;
						}
						else{
							$fullTeams[] = $teamtournament;
							$matchedTournament->addFullTeam($teamtournament);
						}
					}
					$v->assign("freeTeams", $freeTeams);
					$v->assign("fullTeams", $fullTeams);
				};
				if($this->isVisitorConnected()){
					$userAlrdyRegistered = $rm->isUserRegisteredForTournament($matchedTournament, $this->getConnectedUser());
					// /!\ LORSQUE L'USER N'EST PAS INSCRIT ON SFAIT $userAlrdyRegistered === FALSE DONC CETTE VARIABLE SERA SUPPRIMEE PAR LE FILTER ARRAY DS LE extract() de view.class
					$v->assign("userAlrdyRegistered", $userAlrdyRegistered);
					$v->assign("_user", $this->getConnectedUser());
					unset($ttm, $tm, $rm);
					$_SESSION['lastTournamentChecked'] = $link;
				}
				// Recuperer tous les matchs du tournoi
				$matchsManager = new matchsManager();
				$allMatchs = $matchsManager->getMatchsOfTournament($matchedTournament);
				// S'il y a des matchs
				if(!!$allMatchs && $allMatchs != "none"){
					$ttm = new teamtournamentManager();
					$rm = new registerManager();
					foreach ($allMatchs as $key => $m) {
						$teamsOfMatch = $ttm->getTeamsOfMatch($matchedTournament, $m);
						if(!!$teamsOfMatch){
							foreach ($teamsOfMatch as $key => $teamOfMatch) {
								$usersInTeam = $rm->getTeamTournamentUsers($teamOfMatch);
								if(is_array($usersInTeam))
									$teamOfMatch->addUsers($usersInTeam);
								$m->addTeamTournament($teamOfMatch);
							}
						}
						$matchedTournament->addMatch($m);
						// var_dump($m);
					}
					unset($ttm, $rm);
				}
				$v->assign("tournoi", $matchedTournament);
				$v->setView("detailtournoiDOM");
				return;
			};
			unset($tm);
			// Aucun tournoi n'a été trouvé pour l'url reçue
			$v->assign("css", "404");
			$v->assign("js", "404");
			$v->assign("title", "Erreur 404");
	        $v->assign("content", "Erreur 404, <a href='".WEBPATH."/index'>Retour à l'accueil</a>.");
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
	// Destiné à de l'AJAX
	public function randRegisterAction(){
		// On vérifie ici que le mec était bien sur une page tournoi		
		if(!isset($_SESSION['lastTournamentChecked']))
			$this->echoJSONerror("tournoi","aucun tournoi visité");
		$args = array(
            't' => FILTER_SANITIZE_STRING,
            'sJeton' => FILTER_SANITIZE_STRING
		);
		$filteredinputs = filter_input_array(INPUT_POST, $args);
		$filteredinputs = array_filter($filteredinputs);
		foreach ($args as $key => $value) {
			if(!isset($filteredinputs[$key]))
				$this->echoJSONerror("inputs","missing input " . $key);
    	}

		// SECU ANTI CSRF
		if($filteredinputs['sJeton'] !== $_SESSION['sJeton'])
			$this->echoJSONerror("csrf","jetons ".$filteredinputs['sJeton']." et ".$_SESSION['sJeton']." differents !");
		$link = $filteredinputs['t'];
		// On vérifie que l'user tente de bien de s'inscrire au tournoi qu'il a visité
		if($link !== $_SESSION['lastTournamentChecked'])
			$this->echoJSONerror("tournoi","link different du dernier tournoi visité");

		$tm = new tournamentManager();
		$matchedTournament = $tm->getTournamentWithLink($link);
		// Si le chercheur renvoie autre chose que false
		if(!!$link && is_bool(strpos($link, 'null')) && $matchedTournament !== false){
			$rm = new registerManager();
			// On vérifie l'égibilité de l'user au tournoi
			if(!canUserRegisterToTournament($this->getConnectedUser(), $matchedTournament))
				$this->echoJSONerror('','Vous ne pouvez pas vous inscrire dans ce tournoi');
			$ttm = new teamtournamentManager();
			$allTournTeams = $ttm->getTournamentTeams($matchedTournament);

			if(!!$allTournTeams){
				$freeTeams = [];
				$fullTeams = [];
				// On ajoute tous les users inscrit à chaque team du tournoi
				foreach ($allTournTeams as $key => $teamtournament) {
					$usersInTeam = $rm->getTeamTournamentUsers($teamtournament);
					if(is_array($usersInTeam))
						$teamtournament->addUsers($usersInTeam);
					if(canUserRegisterToTeamTournament($this->getConnectedUser(), $matchedTournament, $teamtournament))
						$freeTeams[] = $teamtournament;
					else
						$fullTeams[] = $teamtournament;
				}
				if((bool)$matchedTournament->getRandomPlayerMix()){
					// On recupere une equipe random à laquelle affecter l'user
					$affectedTeam = $this->getRandomTeamToAffectUser($matchedTournament, $freeTeams);
					// On l'ajoute à la team
					$rm->mirrorObject = new register([
						'status' => 1,
						'idTeamTournament' => $affectedTeam->getId(),
						'idUser' => $this->getConnectedUser()->getId(),
						'idTournament' => $matchedTournament->getId()
					]);
					if($rm->create() !== FALSE){
						echo json_encode(["enregistrement" => true]);
						return;
					}
					else
						$this->echoJSONerror("enregistrement", "problème lors de votre affectation à l'équipe du tournoi " . $matchedTournament->getName());
				}
				// Pas d'affectation aléatoire activée pour ce tournoi
				else{
					echo "Il faut une team à choisir !";
				}
			}
			else
				$this->echoJSONerror('tournoi', 'aucune equipe trouvée pour ce tournoi');
		};
		unset($tm);
	}

	public function teamRegisterAction(){
		if(!isset($_SESSION['lastTournamentChecked']))
			$this->echoJSONerror("tournoi","aucun tournoi visité");
		$args = array(
            't' => FILTER_SANITIZE_STRING,
            'ttid' => FILTER_VALIDATE_INT,
            'sJeton' => FILTER_SANITIZE_STRING
		);
		$filteredinputs = filter_input_array(INPUT_POST, $args);
		$filteredinputs = array_filter($filteredinputs);
		foreach ($args as $key => $value) {
			if(!isset($filteredinputs[$key]))
				$this->echoJSONerror("inputs","missing input " . $key);
    	}

		// SECU ANTI CSRF
		if($filteredinputs['sJeton'] !== $_SESSION['sJeton'])
			$this->echoJSONerror("csrf","jetons ".$filteredinputs['sJeton']." et ".$_SESSION['sJeton']." differents !");
		$link = $filteredinputs['t'];
		// On vérifie que l'user tente de bien de s'inscrire au tournoi qu'il a visité
		if($link !== $_SESSION['lastTournamentChecked'])
			$this->echoJSONerror("","link different du dernier tournoi visité");

		$tm = new tournamentManager();
		$matchedTournament = $tm->getTournamentWithLink($link);

		// Si le chercheur renvoie autre chose que false
		if(!!$link && is_bool(strpos($link, 'null')) && $matchedTournament !== false){
			// On vérifie l'égibilité de l'user au tournoi
			if(!canUserRegisterToTournament($this->getConnectedUser(), $matchedTournament))
				$this->echoJSONerror('', 'vous ne pouvez pas vous inscrire dans ce tournoi');

			$tt = new teamtournament(['id' => $filteredinputs['ttid']]);
			// On récupère la team visée en db
			$ttm = new teamtournamentManager();
			$tt = $ttm->getTeamtournamentById($tt);

			$rm = new registerManager();
			$usersInTeam = $rm->getTeamTournamentUsers($tt);
			if(is_array($usersInTeam))
				$tt->addUsers($usersInTeam);

			// on vérifie que l'utilisateur peut bien s'inscrire ds cette team
			if(!canUserRegisterToTeamTournament($this->getConnectedUser(), $matchedTournament, $tt))
				$this->echoJSONerror('', 'vous ne pouvez pas vous inscrire dans cette équipe');

			// On peut désormais enregistrer l'user dans la team
			$register = new register([
				'status' => 1,
				'idTeamTournament' => $tt->getId(),
				'idUser' => $this->getConnectedUser()->getId(),
				'idTournament' => $matchedTournament->getId()
			]);
			$rm->mirrorObject = $register;
			if($rm->create()){
				echo json_encode(["success" => "Vous avez été inscrit au tournoi ".$matchedTournament->getName()]);
				return;
			}
			else
				$this->echoJSONerror("", "problème lors de votre inscription au tournoi '" . $matchedTournament->getName()."'");
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

		$v = new view();
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
			$userCanRegisterTournaments = [];
			$closedToUserTournaments = [];
			$ownedTournaments = [];
			$joinedTournament = [];
			if(!!$matchedTournaments){								
				if($this->isVisitorConnected()){
					foreach ($matchedTournaments as $key => $t) {
						$filledT = $this->getFullyAlimentedTournament($t, false);
						if($t->getIdUserCreator() == $this->getConnectedUser()->getId()){
							if(!!$filledT)
								$ownedTournaments[] = $filledT;
							else
								$ownedTournaments[] = $t;
						}
						else{
							if($filledT instanceof tournament){
								if($filledT->isUserRegistered($this->getConnectedUser())){
									$joinedTournament[] = $filledT;
								}
								else{
									$matchedTournaments[$key] = $filledT;
									if(canUserRegisterToTournament($this->getConnectedUser(), $filledT, true))
										$userCanRegisterTournaments[] = $filledT;
									else
										$closedToUserTournaments[] = $filledT;
								}							
							}
							else{
								// Bcp moins précis
								if(canUserRegisterToTournament($this->getConnectedUser(), $t))
									$userCanRegisterTournaments[] = $t;
								else
									$closedToUserTournaments[] = $t;
							}
						}
					}
				}
				$v->assign("joinedTournament", $joinedTournament);
				$v->assign("ownedTournaments", $ownedTournaments);
				$v->assign("userCanRegisterTournaments", $userCanRegisterTournaments);
				$v->assign("closedToUserTournaments", $closedToUserTournaments);				
			}
			$v->assign("tournois", $matchedTournaments);
			// var_dump($matchedTournaments);
		}
		$v->setView("tournamentslist");
	}

	public function unregisterAction(){
		if(!isset($_SESSION['lastTournamentChecked']))
			$this->echoJSONerror("tournoi","aucun tournoi visité");
		$args = array(
            't' => FILTER_SANITIZE_STRING,
            'sJeton' => FILTER_SANITIZE_STRING
		);
		$filteredinputs = array_filter(filter_input_array(INPUT_POST, $args));
		foreach ($args as $key => $value) {
			if(!isset($filteredinputs[$key]))
				$this->echoJSONerror("inputs","missing input " . $key);
    	}

		// SECU ANTI CSRF
		if($filteredinputs['sJeton'] !== $_SESSION['sJeton'])
			$this->echoJSONerror("csrf","jetons ".$filteredinputs['sJeton']." et ".$_SESSION['sJeton']." differents !");
		$link = $filteredinputs['t'];
		// On vérifie que l'user tente de bien de s'inscrire au tournoi qu'il a visité
		if($link !== $_SESSION['lastTournamentChecked'])
			$this->echoJSONerror("tournoi","link different du dernier tournoi visité");

		$tm = new tournamentManager();
		$matchedTournament = $tm->getTournamentWithLink($link);
		if(!!$matchedTournament){
			$rm = new registerManager();			
			if($rm->isUserRegisteredForTournament($matchedTournament, $this->getConnectedUser())){
				if($rm->deleteRegisteredFromTournament($matchedTournament, $this->getConnectedUser()))
					echo json_encode(["success" => true]);
				else
					$this->echoJSONerror("desinscription", "votre desincription a échoué");
			}
			else
				$this->echoJSONerror("utilisateur","vous n'êtes pas inscrit à ce tournoi !");
		}
		else
			$this->echoJSONerror("tournoi","tournoi inexistant");
	}

	// Algo d'affectation aléatoire à une team de tournoi lors du register
	private function getRandomTeamToAffectUser(tournament $t, array $teams){
		// Si les joueurs sont en solo ds l'equipe
		if($t->getMaxPlayerPerTeam() === 1)
			return $teams[rand(0, count($teams)-1)];
		else{
			$tableauPondere = [];
			$maxPpt = (int) $t->getMaxPlayerPerTeam();
			foreach ($teams as $key => $team) {
				$occ = $maxPpt - $team->getTakenPlaces();
				for ($i=0; $i < $occ; $i++) { 
					$tableauPondere[] = $team;
				}
			}
			return $tableauPondere[rand(0, count($tableauPondere)-1)];
		}
	}
}
