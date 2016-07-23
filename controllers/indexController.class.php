<?php
class indexController extends template{
	public function indexAction($requiredPosts){
		$v = new view();
		$this->assignConnectedProperties($v);
		$v->assign("css", "index");
		$v->assign("js", "index");

		//Categorie
		$obj = new typegameManager();
		$typeJeu = $obj->getAllTypes();
		if(!empty($typeJeu)){
			$v->assign("categorie", $typeJeu);	
		}


		//Liste Tournois
		$obj = new tournamentManager();
		//Le paramètre par défaut vaut NULL si l'utilisateur n'est pas connecté
		$listetournois = $obj->getUnstartedTournaments($this->connectedUser);
		if(!!($listetournois)){
			$v->assign("listeTournois", $listetournois);
		}
		
		// Cette variable de session est créé uniquement lorsqu'un compte vient d'être validé
		if(isset($_SESSION['compte_validé'])){
			$v->assign("compteValide", $_SESSION['compte_validé']);
			unset($_SESSION['compte_validé']);
		}

		//Liste des matchs à venir
		/*$obj = new gameManager();
		$listejeux = $obj->getAllGames();
		if(!!($listejeux)){
			$v->assign("listeJeux", $listejeux);
		}*/
		
		$mm = new matchsManager();
		$nextMatchs = $mm->getNextMatchsOfEveryTournament(4);
		if(isset($nextMatchs) && is_array($nextMatchs)){
			foreach ($nextMatchs as $key => $m) {
				$nextMatchs[$key] = $this->getFullyAlimentedMatch($m);
			}
			$v->assign("listeMatchs", $nextMatchs);
		}

		//Jeu le plus utilisé
		$obj = new gameManager();
		$bestGames = $obj->getBestGames();
		if(isset($bestGames) && !empty($bestGames) && $bestGames[0]['nb_util_jeu']!=0){
			$v->assign("bestGames", $bestGames);
		}

		$v->setView("index");
	}

	public function contactAdminAction(){
		$args = array(
				'expediteur' => FILTER_VALIDATE_EMAIL,
				'message' => FILTER_SANITIZE_STRING 
				);
		$filteredinputs = array_filter(filter_input_array(INPUT_POST, $args));


		/*
			###########################################################################
			###########################################################################
		*/
			// ARRAY FILTER SUPPRIME LES MSG VIDES, 0, FALSE ou NULL
			// IL FAUT OBLIGATOIREMENT UTILISER CETTE METHODE DE FOREACH APRES UN array_filter(filter_input_array)
		/*
			###########################################################################
			###########################################################################
		*/
		foreach ($args as $key => $value) {
			if(!isset($filteredinputs[$key])){      
				$this->echoJSONerror("","Il manque un champ.");
			}
		}	

		$contenuMail = "<h3>Un utilisateur vous a contacté.</h3>";
		$contenuMail .= "<div>Vous pouvez lui répondre à cette adresse : ".$filteredinputs['expediteur'].".</div>";
	    $contenuMail.="<p>Contenu du message: </p>";
	    $contenuMail.="<div>".$filteredinputs['message']."</div>";

		$this->envoiMail('breakemall.contact@gmail.com', 'Demande de contact.', $contenuMail);	
	}


	public function currentTournamentAction(){

		$tournamentBDD = new tournamentManager();
		$tournoi = $tournamentBDD->getRecentsTournaments(1)[0];

		if($tournoi){
			$contenu = "<p>".strtoupper($tournoi->getGameName())."</p>";
			$contenu.="<p><a href='".WEBPATH."/tournoi?t=".$tournoi->getLink()."'>";
				$contenu .= "<img class='img-popup' src='".$tournoi->getGameImg()."'>";
			$contenu .= "</a></p>";
			$contenu.="<p>Date de début: Le ".date('d/m/Y \à h:i',$tournoi->getStartDate())."</p>";
			$contenu.="<p>Date de fin: Le ".date('d/m/Y \à h:i',$tournoi->getEndDate())."</p>";
			echo $contenu;
		}
		else
			echo "<p>Pas de nouveau tournoi de prévu</p>";
	}
}

/*

	SELECT t.id, t.startDate, t.endDate, t.description, t.typeTournament, t.status, t.nbMatch, t.idUserCreator, t.idGameVersion, t.idWinningTeam, t.urlProof, t.creationDate, t.guildOnly, t.randomPlayerMix, t.name, t.link, gv.maxPlayer, gv.maxTeam, gv.maxPlayerPerTeam, gv.name as gvName, gv.description as gvDescription, ga.id as gameId, ga.name as gameName, ga.description as gameDescription, ga.img as gameImg, ga.year as gameYear, ga.idType as gtId, p.id as pId, p.name as pName, p.description as pDescription, p.img as pImg, u.pseudo as userPseudo, COUNT(r.id) as numberRegistered 
	FROM tournament t LEFT OUTER JOIN gameversion gv ON t.idgameVersion = gv.id LEFT OUTER JOIN game ga ON ga.id = gv.idGame LEFT OUTER JOIN platform p ON p.id = gv.idPlateform LEFT OUTER JOIN user u ON u.id = t.idUserCreator LEFT OUTER JOIN register r ON r.idTournament = t.id WHERE t.startDate > UNIX_TIMESTAMP(LOCALTIME()) ORDER BY t.startDate	

			

		


 */