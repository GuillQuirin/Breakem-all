<?php 
class teamController extends template{
	public function teamAction(){
		$v = new View();
		$v->assign("css", "team");
		$v->assign("js", "team");
		$v->assign("title", "Team");
		$v->assign("content", "Liste des Teams");
		$v->setView("team");
	}

	public function verifyAction(){
		$args = array(
        'name'     => FILTER_SANITIZE_STRING,    
        'slogan'     => FILTER_SANITIZE_STRING,   
	    'description'     => FILTER_SANITIZE_STRING    
		);
		$filteredinputs = filter_input_array(INPUT_POST, $args);
		// Ce finalArr doit etre envoyé au parametre du constructeur de usermanager
		$finalArr = [];
        
		foreach ($args as $key => $value) {
			if(!isset($filteredinputs[$key]))
				die("FAUX: ".$filteredinputs[$key]);
		}

	if(strlen($filteredinputs['name'])<2 || strlen($filteredinputs['name'])>45)
       	die("FAIL name");	
    else
       $finalArr['name']=trim($filteredinputs['name']);

   if(strlen($filteredinputs['slogan'])<2 || strlen($filteredinputs['slogan'])>45)
        die("FAIL slogan");   
    else
       $finalArr['name']=trim($filteredinputs['name']);

    if(strlen($filteredinputs['description'])>200)
        die("FAIL description"); 
    else
       $finalArr['description']=trim($filteredinputs['description']);


    $team = new team($finalArr);

    // C'est avec cet objet qu'on utilisera les fonctions d'interaction avec la base de donnees
    $teamBDD = new teamManager();
    
    // On check le nom de la team
    $exist_name=$teamBDD->nameExists($team->getName());
    if($exist_name)
    	var_dump("Team already used !");

    // On check le statut de l'utilisateur avec les teams
    $own_team=$teamBDD->rightsExist($_SESSION['token']);
    if($own_team)
    	var_dump("User already has a team !");

    // On enregistre la team
    //->Fonctionne
    $teamBDD->create($team);

    $id = $team->getId();

    // On attribue à l'utilisateur le statut de proprietaire de la team
    //-> Ne fonctionne pas
    /*$teamBDD->setOwnerTeam(1, $_SESSION['token']);*/
	}
}