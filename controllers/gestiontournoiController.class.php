<?php

class gestiontournoiController extends template{
	
	public function __construct(){
		parent::__construct();

		//Visiteur ou membre banni
		if(!($this->isVisitorConnected()) || $this->connectedUser->getStatus()<1){
		 	header('Location: ' .WEBPATH);
		}
	}

	public function gestiontournoiAction(){

		$v = new view();
		$this->assignConnectedProperties($v);

		$args = array('t' => FILTER_SANITIZE_STRING);

		$filteredinputs = filter_input_array(INPUT_GET, $args);

		//Si lien fourni sinon redirection liste tournoi
		if(!empty($filteredinputs) && $this->isVisitorConnected()){

			$filteredinputs = array_filter($filteredinputs);
			$link = $filteredinputs['t'];

			$tournamentBDD = new tournamentManager();

			//On vérifie que l'utilisateur est bien propriétaire du tournoi

			$tournament = $tournamentBDD->getTournamentWithLink($link);

			if(!!$link && is_bool(strpos($link, 'null')) && $tournament !== false 
					&& $tournament->getIdUserCreator()==$this->connectedUser->getId()){

				$v->assign("css", "gestiontournoi");
				$v->assign("js", "gestiontournoi");
				$v->assign("title", "Gestion de votre tournoi");
				$v->assign("tournoi",$tournament);
				$v->assign("content", "Gérer votre tournoi");

				/* MAJ effectuées auparavant */
				if(isset($_SESSION['referer_method'])){
					
					$e = new Exception();
					$trace = $e->getTrace();

					// Classe appelante
					$calling_class = (isset($trace[0]['class'])) ? $trace[0]['class'] : false;

					//Methode appelante
					$calling_method = $_SESSION['referer_method'];

					if($calling_class === "gestiontournoiController" && $calling_method === "update")
						$v->assign("MAJ","1");

					unset($_SESSION['referer_method']);
				}

				// Recuperer tous les participants
				$rm = new registerManager();
				$allRegistered = $rm->getTournamentParticipants($tournament);
				// Ne les envoyer ds la vue que s'il y en a
				if(!!$allRegistered)
					$v->assign("allRegistered", $allRegistered);

				// Recuperer toutes les équipes avec le nombre de places prises
				$ttm = new teamtournamentManager();
				$allTournTeams = $ttm->getTournamentTeams($tournament);
				if(!!$allTournTeams){
					$freeTeams = [];
					$fullTeams = [];
					foreach ($allTournTeams as $key => $teamtournament) {
						$usersInTeam = $rm->getTeamTournamentUsers($teamtournament);
						if(is_array($usersInTeam))
							$teamtournament->addUsers($usersInTeam);
						if($teamtournament->getTakenPlaces() < $tournament->getMaxPlayerPerTeam())
							$freeTeams[] = $teamtournament;
						else
							$fullTeams[] = $teamtournament;
					}
					$v->assign("freeTeams", $freeTeams);
					$v->assign("fullTeams", $fullTeams);
				};

				$v->setView("gestiontournoi");
				return;
			};
			unset($tm);
			header('Location: '.WEBPATH.'/404');
		}
		// Pas de get connu reçu, on affiche la page par défaut des tournois
		else
			header('Location: '.WEBPATH.'/tournoi');		
	}
	
	public function updateAction(){
	    //  infos récuperées après filtre de sécurité de checkUpdateInputs()
	    $checkedDatas = $this->checkUpdateInputs();
	   
	    $user = $this->getConnectedUser();
		
		$filteredinputs = array_filter($filteredinputs);
			$link = $filteredinputs['t'];

			$tournamentBDD = new tournamentManager();

			//On vérifie que l'utilisateur est bien propriétaire du tournoi

			$tournament = $tournamentBDD->getTournamentWithLink($link);

			if(!!$link && is_bool(strpos($link, 'null')) && $tournament !== false 
					&& $tournament->getIdUserCreator()==$this->connectedUser->getId()){
				
			    // C'est avec cet objet qu'on utilisera les fonctions d'interaction avec la base de donnees
			    $userBDD = new userManager();
			    $newuser = new user($checkedDatas);

			    //On force la MAJ des checkbox même si elles sont vides
			    $newuser->setRss(isset($checkedDatas['rss']));
			    $newuser->setAuthorize_mail_contact(isset($checkedDatas['authorize_mail_contact']));

			    // On met à jour
			    $userBDD->setUser($user, $newuser);
			    $expiration = time() + (86400 * 7);
				if(array_key_exists("email", $checkedDatas)){
					$_SESSION[COOKIE_EMAIL]=$checkedDatas['email'];
					setcookie(COOKIE_EMAIL, null,-1,'/');
					setcookie(COOKIE_EMAIL, $checkedDatas['email'],$expiration,'/');
					setcookie(COOKIE_TOKEN, $_SESSION[COOKIE_TOKEN],$expiration,'/');
				}

				$_SESSION['referer_method']="update";

				header("Location: ".$_SERVER['HTTP_REFERER']."");
			}
	}

	//Methode présente dans Controller et non template car on ne peut faire de MAJ qu'ici
	private function checkUpdateInputs(){

		//FILTER_SANITIZE_STRING Remove all HTML tags from a string
	    $args = array(
	      'nom' => FILTER_SANITIZE_STRING,
	      'description'   => FILTER_SANITIZE_STRING,
	      'Dday'   => FILTER_SANITIZE_STRING,     
	      'Dmonth'   => FILTER_SANITIZE_STRING,     
	      'Dyear'   => FILTER_SANITIZE_STRING,
	      'Eday'   => FILTER_SANITIZE_STRING,     
	      'Emonth'   => FILTER_SANITIZE_STRING,     
	      'Eyear'   => FILTER_SANITIZE_STRING
	      
	    );

		$filteredinputs = filter_input_array(INPUT_POST, $args);

		//Début tournoi
		$filteredinputs['Dmonth'] = (int) $filteredinputs['Dmonth'];
	    $filteredinputs['Dday'] = (int) $filteredinputs['Dday'];
	    $filteredinputs['Dyear'] = (int) $filteredinputs['Dyear'];

	    //Fin tournoi
		$filteredinputs['Emonth'] = (int) $filteredinputs['Emonth'];
	    $filteredinputs['Eday'] = (int) $filteredinputs['Eday'];
	    $filteredinputs['Eyear'] = (int) $filteredinputs['Eyear'];
	    

	    if(!checkdate($filteredinputs['Dmonth'], $filteredinputs['Dday'], $filteredinputs['Dyear']) || !checkdate($filteredinputs['Emonth'], $filteredinputs['Eday'], $filteredinputs['Eyear']))
	      $this->echoJSONerror('date', 'La date reçue a fail !');
	    else{

	      $datedeb = DateTime::createFromFormat('j-n-Y',$filteredinputs['Dday'].'-'.$filteredinputs['Dmonth'].'-'.$filteredinputs['Dyear']);

	      $datefin = DateTime::createFromFormat('j-n-Y',$filteredinputs['Eday'].'-'.$filteredinputs['Emonth'].'-'.$filteredinputs['Eyear']);
	      
	      if(!$datedeb || !$datefin)
	      	$this->echoJSONerror('date', 'La date reçue a fail !');

			$filteredinputs['date_deb'] = date_timestamp_get($datedeb);
			$filteredinputs['date_fin'] = date_timestamp_get($datefin);
	    }  	

	    return array_filter($filteredinputs);
  	}


  	public function deleteTourAction(){

        $args = array(
            'id' => FILTER_VALIDATE_INT
            //'delname' => FILTER_SANITIZE_STRING
        );

        $filteredinputs = filter_input_array(INPUT_POST, $args);

        $gameBDD = new gameManager();
        $game = $gameBDD->getGameById($filteredinputs['id']);
    
        if($game)
            $gameBDD->deleteGames($game);
        else
            return null;
    }


}
