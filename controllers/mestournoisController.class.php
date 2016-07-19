<?php

class mestournoisController extends template{

	public function __construct(){
		parent::__construct();
		if(!($this->isVisitorConnected())){
			header('Location: ' .WEBPATH.'/index');
		}
	}

	public function mestournoisAction(){
  		$v = new view();
		$this->assignConnectedProperties($v);

        $obj = new tournamentManager();
        $listetournois = $obj->getUnstartedTournaments();
        if(!!($listetournois)){
            $v->assign("listeTournois", $listetournois);
        }

		//Liste Tournois
        $v->assign("css", "mestournois");
        $v->assign("js", "mestournois");
        $v->assign("title", "tournois");
        $v->assign("content", "Liste des tournois");
        $v->setView("mestournois", "template");
	}

	/* Tournoi organisé pour l'utilisateur */
	public function getTournamentsOrganisedByUserAction(){

	 	$args = array(
            'pseudo' => FILTER_SANITIZE_STRING
        );

        $filteredinputs = filter_input_array(INPUT_GET, $args);  
        //Bdd
        $bddTournament = new tournamentManager();
        $bddUser = new userManager();
        //Data
        $dataUser = $bddUser->getUser($filteredinputs);
        //Request
        $req = $bddTournament->getTournamentsOrganisedByUser($dataUser);

        if($req){
            print_r($req);
            die();
        }else{
            echo "undefined";
            die();
        }   
	}
	
}

