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
        $v->assign("css", "mestournois");
        $v->assign("js", "mestournois");
        $v->assign("title", "tournois");
        $v->assign("content", "Liste des tournois");
        $v->setView("mestournois", "template");
	}
	
    public function mestournoisOrgAction(){
        //View
        $v = new view();

        //User data
        $this->assignConnectedProperties($v);
        $pseudo = $this->connectedUser->getPseudo();
        $userTMP = new user(array("pseudo" => $pseudo));

        //Bdd
        $bddUser = new userManager();
        $bddTournament = new tournamentManager();

        //Request
        $user = $bddUser->userByPseudoInstance($userTMP);
        $tournamentOrg = $bddTournament->getTournamentsOrganisedByUser($user, 10);
        
        //Data
        //echo json_encode($tournamentOrg);        
        $v->assign("tournamentOrg",$tournamentOrg);
        $v->setView("mestournoisOrg", "templateEmpty");
    }

   public function mestournoisPartAction(){
        //View
        $v = new view();

        //User data
        $this->assignConnectedProperties($v);
        $pseudo = $this->connectedUser->getPseudo();
        $userTMP = new user(array("pseudo" => $pseudo));

        //Bdd
        $bddUser = new userManager();
        $bddTournament = new tournamentManager();

        //Request
        $user = $bddUser->userByPseudoInstance($userTMP);
        $tournamentPart = $bddTournament->getTournamentsPlayedByUser($user, 10);
        
        //Data
        //echo json_encode($tournamentOrg);        
        $v->assign("tournamentPart",$tournamentPart);
        $v->setView("mestournoisPart", "templateEmpty");
    }
}

