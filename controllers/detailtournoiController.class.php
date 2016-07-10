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
						if($mm->create()){
							$dbMatch = $mm->getLastCreatedMatchOfTournament($matchedTournament);
							if(!!$dbMatch)
								if($this->createMatchParticipantsOfMatch($dbMatch, $createdMatchs->gtAllTeamsTournament())){
									echo json_encode(["success" => "Un premier match aura lieu pour éliminer l'équipe en trop !"]);
									exit;
								}

							else{
								// On ne peut pas récupérer le dernier match créé et on ne peut pas relier les matchsparticipants au dernier match sans l'id nouvellement créé en db -> il faut donc supprimer le match avant d'afficher l'erreur
								$this->echoJSONerror("X2", "Problème interne lors de la création du match d'ouverture");
							}
						}
						else
							$this->echoJSONerror("X1", "Problème interne lors de la création du match d'ouverture");
						$this->echoJSONerror("X4", "Problème interne lors de la création du match d'ouverture");
					}
					// Le nombre d'équipe est pair
					else if(is_array($createdMatchs) && count($createdMatchs) > 0){
						$errors = false;
						foreach ($createdMatchs as $key => $createdMatch) {
							$mm = new matchsManager();
							$mm->mirrorObject = $createdMatch;
							if($mm->create()){
								$dbMatch = $mm->getLastCreatedMatchOfTournament($matchedTournament);
								if(!!$dbMatch)
									if(!$this->createMatchParticipantsOfMatch($dbMatch, $createdMatch->gtAllTeamsTournament()))
										$this->echoJSONerror("X8", "Problème interne lors de la création des matchs d'ouverture");
								else{
									// On ne peut pas récupérer le dernier match créé et on ne peut pas relier les matchsparticipants au dernier match sans l'id nouvellement créé en db -> il faut donc supprimer le match avant d'afficher l'erreur
									$this->echoJSONerror("X7", "Problème interne lors de la création des matchs d'ouverture");
								}
							}
							else
								$this->echoJSONerror("X6", "Problème interne lors de la création des matchs d'ouverture");
						}
						echo json_encode(["success" => "La première série de matchs a été créée !"]);
						exit;
					}
					else
						$this->echoJSONerror("X10", "Problème interne lors de la création du match d'ouverture");
				}
					
			};
		}
	}

	public function selectWinnerAction(){
		if(!$this->isVisitorConnected())
			$this->echoJSONerror("","Vous n'êtes pas connecté !");
		if(!isset($_SESSION['lastTournamentChecked']))
			$this->echoJSONerror("tournoi","aucun tournoi visité");
		$args = array(
            't' => FILTER_SANITIZE_STRING,
            'sJeton' => FILTER_SANITIZE_STRING,
            'mId' => FILTER_VALIDATE_INT,
            'ttId' => FILTER_VALIDATE_INT
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

		if(!!$link && is_bool(strpos($link, 'null')) && $matchedTournament !== false && $this->getConnectedUser()->getId() == $matchedTournament->getIdUserCreator() && !is_numeric($matchedTournament->getIdWinningTeam())){
			// Recuperer tous les participants
			$rm = new registerManager();
			$allRegistered = $rm->getTournamentParticipants($matchedTournament);

			// Recuperer toutes les équipes avec le nombre de places prises
			$ttm = new teamtournamentManager();
			$allTournTeams = $ttm->getTournamentTeams($matchedTournament);
			if(!!$allTournTeams){
				foreach ($allTournTeams as $key => $teamtournament) {
					$usersInTeam = $rm->getTeamTournamentUsers($teamtournament);
					if(is_array($usersInTeam))
						$teamtournament->addUsers($usersInTeam);
					if($teamtournament->getTakenPlaces() < $matchedTournament->getMaxPlayerPerTeam())
						$matchedTournament->addFreeTeam($teamtournament);
					else
						$matchedTournament->addFullTeam($teamtournament);
				}
			}
			else
				$this->echoJSONerror("error: DT_SW_1", "aucune équipe n'est créée pour ce tournoi !");
			// Recuperer tous les matchs du tournoi
			$matchsManager = new matchsManager();
			$allMatchs = $matchsManager->getMatchsOfTournament($matchedTournament);
			// S'il y a des matchs
			if(!!$allMatchs){
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
			else
				$this->echoJSONerror("error: DT_SW_2", "aucun match n'a été créé pour ce tournoi !");

			// Arrivé ici on a récupéré les matchs et leurs équipes participantes, ainsi qu'une liste de toutes les équipes. Toutes ces entités sont remplies de leurs datas correspondantes et respectives
			$m = new matchs(['id' => $filteredinputs['mId']]);
			$winnerTT = new teamtournament(['id' => $filteredinputs['ttId']]);
			$teamAndMatchArr = $this->getTeamOfMatchAndMatch($matchedTournament, $m, $winnerTT);
			if(is_array($teamAndMatchArr)){
				$m = $teamAndMatchArr['m'];
				$winnerTT = $teamAndMatchArr['tt'];
				// À partir d'ici on peut être sûr d'avoir reçu un match qui n'est pas encore joué et que l'équipe reçue participe bien à ce match
				/* ---> On peut donc update la table match et renvoyer un success à la view */
				$mm = new matchsManager();
				if($mm->setMatchWinner($m, $winnerTT))
					echo json_encode(["success"=>"L'équipe ".$matchedTournament->gtPublicTeamIdToPrint($winnerTT) . "remporte donc le match"]);
				else
					$this->echoJSONerror("error: DT_SW_4", "Impossible de définir l'équipe ".$matchedTournament->gtPublicTeamIdToPrint($winnerTT)." comme gagnante, si le problème persiste veuillez contacter un admin");
				exit;
			}
			else
				$this->echoJSONerror("error: DT_SW_3", "L'équipe et le match ne correspondent pas");
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

	/*
	 **@params (matchs) match récupéré en db, (array) teamtournaments ac id
	 **returns (boolean)
	 --> Insert en db les équipes asssociées au match nouvellement inséré en base
	*/
	private function createMatchParticipantsOfMatch(matchs $m, $teamsTournamentsArray){
		$mpm = new matchParticipantsManager();
		foreach ($teamsTournamentsArray as $key => $tt) {
			$mp = new matchParticipants([
				'idMatch' => $m->getId(),
				'idTeamTournament' => $tt->getId()
			]);
			$mpm->mirrorObject = $mp;
			if(!$mpm->create()){
				unset($mpm);
				$this->echoJSONerror("X3", "Problème interne lors de la création du match d'ouverture");
			}
		}
		unset($mpm);
		return true;
	}

	private function getTeamOfMatchAndMatch(tournament $t, matchs $m, teamtournament $tt){
		$realMatchId = $t->gtRevertPublicMatchId($m);
		$realTeamId = $t->gtRevertPublicTeamId($tt);
		foreach ($t->gtAllMatchs() as $key => $match) {
			if(!$match->gtWinningTeam() && $match->getId() == $realMatchId){
				foreach ($match->gtAllTeamsTournament() as $key => $team) {
					if($team->getId() == $realTeamId)
						return ['m'=>$match, 'tt'=>$team];
				}
			}
			else if($match->gtWinningTeam() && $match->getId() == $realMatchId)
				$this->echoJSONerror("error: DT_GTMM_1", "Ce match s'est déjà vu choisir un vainqueur");

		}
		return false;
	}
	
}
