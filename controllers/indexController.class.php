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

		/*##### ON N'OUVRE PAS DEUX CONNECTIONS POUR UN MM MANAGER*/
		//Pagination
		$pagination = $obj->getAllTypes();
		if(!empty($pagination)){
			$v->assign("pagination", $pagination);
		}

		//Liste Tournois
		$obj = new tournamentManager();
		$listetournois = $obj->getUnstartedTournaments();
		if(!!($listetournois)){
			$v->assign("listeTournois", $listetournois);
		}
		
		// Cette variable de session est créé uniquement lorsqu'un compte vient d'être validé
		if(isset($_SESSION['compte_validé'])){
			$v->assign("compteValide", $_SESSION['compte_validé']);
			unset($_SESSION['compte_validé']);
		}

		//Meilleurs Jeux
		$obj = new gameManager();
		$bestGames = $obj->getBestGames();
		if(!empty($bestGames)){
			$v->assign("bestGames", $bestGames);
		}
		
		$v->setView("index");
	}

	public function contactAdminAction(){
		var_dump($_POST);exit;
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
				die("Manque information : ".$key);
			}
		}	

		$contenuMail = "<h3>Un utilisateur vous a contacté.Vous pouvez lui répondre à <a href='".$filteredinputs['expediteur']."'>cette adresse</a>.</h3>";
	    $contenuMail.="<div>".$filteredinputs['msg']."</div>";

		$this->envoiMail('breakemall.contact@gmail.com', 'Demande de contact.', $contenuMail);

		header('Location: '.$_SERVER['HTTP_REFERER']);
		
	}

}
/*

	SELECT t.id, t.startDate, t.endDate, t.description, t.typeTournament, t.status, t.nbMatch, t.idUserCreator, t.idGameVersion, t.idWinningTeam, t.urlProof, t.creationDate, t.guildOnly, t.randomPlayerMix, t.name, t.link, gv.maxPlayer, gv.maxTeam, gv.maxPlayerPerTeam, gv.name as gvName, gv.description as gvDescription, ga.id as gameId, ga.name as gameName, ga.description as gameDescription, ga.img as gameImg, ga.year as gameYear, ga.idType as gtId, p.id as pId, p.name as pName, p.description as pDescription, p.img as pImg, u.pseudo as userPseudo, COUNT(r.id) as numberRegistered 
	FROM tournament t LEFT OUTER JOIN gameversion gv ON t.idgameVersion = gv.id LEFT OUTER JOIN game ga ON ga.id = gv.idGame LEFT OUTER JOIN platform p ON p.id = gv.idPlateform LEFT OUTER JOIN user u ON u.id = t.idUserCreator LEFT OUTER JOIN register r ON r.idTournament = t.id WHERE t.startDate > UNIX_TIMESTAMP(LOCALTIME()) ORDER BY t.startDate	

			

		


 */