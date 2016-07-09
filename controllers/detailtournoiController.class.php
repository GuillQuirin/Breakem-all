<?php

class detailtournoiController extends template{

	public function detailtournoiAction(){
		$v = new view();
		$this->assignConnectedProperties($v);
		$v->assign("css", "detailtournoi");
		$v->assign("js", "detailtournoi");
		$v->assign("title", "Tournoi <<name>>");
		$v->assign("content", "Tournoi <<name>>");
		$v->setView("detailtournoiDOM");
	}

	public function createFirstMatchsAction(){
		if(!$this->isVisitorConnected())
			$this->echoJSONerror("","Vous n'êtes pas connecté !");
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

		if(!!$link && is_bool(strpos($link, 'null')) && $matchedTournament !== false && $this->getConnectedUser()->getId() == $matchedTournament->getIdUserCreator()){

			// Recuperer tous les participants
			$rm = new registerManager();
			$allRegistered = $rm->getTournamentParticipants($matchedTournament);
			if(!!$allRegistered){
				foreach ($allRegistered as $key => $usr) {
					$matchedTournament->addRegisteredUser($usr);
				}
			}

			// Recuperer toutes les équipes avec le nombre de places prises
			$ttm = new teamtournamentManager();
			$allTournTeams = $ttm->getTournamentTeams($matchedTournament);
			if(!!$allTournTeams){
				foreach ($allTournTeams as $key => $teamtournament) {
					$usersInTeam = $rm->getTeamTournamentUsers($teamtournament);
					if(is_array($usersInTeam))
						$teamtournament->addUsers($usersInTeam);
					if($teamtournament->getTakenPlaces() < $matchedTournament->getMaxPlayerPerTeam() && $teamtournament->getTakenPlaces() != 0)
						$matchedTournament->addFreeTeam($teamtournament);
					else if($teamtournament->getTakenPlaces() == $matchedTournament->getMaxPlayerPerTeam())
						$matchedTournament->addFullTeam($teamtournament);
				}
				if($this->canMatchsBeCreated($matchedTournament)){
					// pondre un algo pour random les rencontres en prévoyant le cas où le nb d'équipe est impair
						// ds ce cas de non-parité: créer un mini tournoi préliminaire pour en éliminer une.
					$createdMatchs = $this->createMatchs($matchedTournament, 2);
					// Le nombre d'équipe était donc impair: il y aura un pré-match
					if($createdMatchs instanceof matchs){
						$mm = new matchsManager();
						$mm->mirrorObject = $createdMatchs;
						print_r($createdMatchs);
						// var_dump($mm->create());
					}
				}
					
			};
		}
	}

	// Le tournoi reçu doit contenir toutes les équipes ainsi que les inscrits
	private function canMatchsBeCreated(tournament $t){
		// Recuperer tous les matchs du tournoi
		$matchsManager = new matchsManager();
		$allMatchs = $matchsManager->getMatchsOfTournament($t);
		if(!!$allMatchs)
			$this->echoJSONerror("", "Les matchs sont déjà créés pour ce tournoi !");
		if($t->getNumberRegistered() < $t->getMaxPlayer() / 2)
			$this->echoJSONerror("", "Pas assez d'inscrit pour créer les matchs !");
		else if($t->getNumberRegistered() >= $t->getMaxPlayer() / 2){
			foreach ($t->gtFreeTeams() as $key => $teamT) {
				print_r($teamT);
				if($teamT->getTakenPlaces() >= $t->getMaxPlayerPerTeam()/2)
					$this->echoJSONerror("", "Pas assez d'inscrit dans la team ". $teamT->getId());
			}
		}

		return true;
	}

	// Le tournoi reçu doit contenir toutes les équipes ainsi que les inscrits
	/*
	 **@params (tournament), (int) nombre d'équipes à faire jouer dans un match
	 **@returns (array[(matchs)] || (matchs)  
	*/
	private function createMatchs(tournament $t, $teamsPerMatch){
		$num = $t->getNumberRegistered();
		$prekey = "s_";
		$allPlayingTeams = $t->gtAllTeams();
		$len = count($allPlayingTeams);
		if($len === 1)
			$this->echoJSONerror("", "Seule une équipe a été trouvée pour ce tournoi !");
		// On crée n matchs où n = $num/2
		if($num%$teamsPerMatch===0){
			$maxNumbMatch = $len/$teamsPerMatch;
			$mirrorMatchs = [];		

			$teamIndexes = [];
			while(count($mirrorMatchs) < $maxNumbMatch){
				// echo "uh oh";
				for ($i=0; $i < $teamsPerMatch; $i++) {
					$newIndex=rand(0, $len-1);
					while( in_array($newIndex, $teamIndexes) )
						$newIndex=rand(0, $len-1);

					$custom_key = $prekey.$newIndex;
					$teamIndexes[$custom_key] = $newIndex;
				}
				

				$match = new matchs([
					"startDate" => $t->getStartDate(),
					'idTournament' =>$t->getId(),
					"matchNumber" => 1
				]);
				foreach ($teamIndexes as $key => $tInd) {
					$match->addTeamTournament($allPlayingTeams[$tInd]);
				}
				$mirrorMatchs[] = $match;
			}
			return $mirrorMatchs;
		}
		// On crée un pré-match pour éliminer assez d'équipe pour qu'il ne reste que des manches "normales"
		else{
			// On se concentrera sur les matchs binaires avec 2 teams participantes
			$numberOfTeamsToEliminate = $num%$teamsPerMatch;
			$match = new matchs([
				"startDate" => $t->getStartDate(),
				'idTournament' =>$t->getId(),
				"matchNumber" => 1
			]);

			$firstTeamIndex=rand(0, $len-1);
			$secondTeamIndex=rand(0, $len-1);
			while($secondTeamIndex === $firstTeamIndex)
				$secondTeamIndex=rand(0, $len-1);

			$match->addTeamTournament($allPlayingTeams[$firstTeamIndex]);
			$match->addTeamTournament($allPlayingTeams[$secondTeamIndex]);

			return $match;
		}
	}
	
}
