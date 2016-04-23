<?php 
class teamController extends template{
	public function teamAction(){
		$v = new View();
    $this->assignConnectedProperties($v);
		$v->assign("css", "team");
		$v->assign("js", "team");
		$v->assign("title", "Team");
		$v->assign("content", "Liste des Teams");
		$v->setView("team");
	}

    private function isFormStringValid($string, $minLen = 4, $maxLen = 25, $spaceAllowed = false, $optionnalCharsAuthorized = ""){
        if(!$spaceAllowed){
            if(strpos($string, ' '))
                 return false;
        }else{
            $string = trim($string);
            $string = str_replace('  ', ' ', $string);
        }
        if(strlen($string) < $minLen || strlen($string) > $maxLen)
            return false;
        $regex = '/[^a-z_\-0-9'. $optionnalCharsAuthorized .']/i';
        if(preg_match($regex, $string))
            return false;
        return true;
    }

	public function verifyAction(){
		$args = array(
            'name'     => FILTER_SANITIZE_STRING,    
            'slogan'     => FILTER_SANITIZE_STRING,   
    	    'description'     => FILTER_SANITIZE_STRING    
		);
		$filteredinputs = filter_input_array(INPUT_POST, $args);
        $data = [];
		foreach ($args as $key => $value) {
			if(!isset($filteredinputs[$key]))
				return json_encode($data["errors"]=["inputs" => "manque: ".$key]);
		}
        if(!($this->isFormStringValid($filteredinputs['name'])))
            return json_encode($data["errors"]=["name" => "le nom ne respecte pas les regles"]);
        if(!($this->isFormStringValid($filteredinputs['slogan'], 10, 50, true, '?!\.')))
            return json_encode($data["errors"]=["slogan" => "le slogan ne respecte pas les règles"]);
        if(!($this->isFormStringValid($filteredinputs['description'], 10, 250, true, '?!\.')))
            return json_encode($data["errors"]=["description" => "la description ne respecte pas les règles"]);

        $team = new team($filteredinputs);
        $dbTeam = new teamManager();

        //Presence du nom en BDD
        if($dbTeam->isNameUsed($team))
            return json_encode($data["errors"]=["nameused" => "nom déjà utilisé"]);
        //L'user a-t-il déjà une team
        if(is_numeric($this->connectedUser->getIdTeam()))
            return json_encode($data["errors"]=["userhasteam" => "vous avez déjà une team!"]);

        //Créaton team
        $newTeam = $dbTeam->create($team);
        if(!$newTeam)
            return json_encode($data["errors"]=["creation" => "pb lors la création de votre team"]);
        // je crois que ça fermera la connexion actuelle
        unset($dbTeam);

        // MàJ de l'idTeam du user connecté
        $dbUser = new userManager();
        $newUser = $dbUser->setNewTeam($this->connectedUser, $r);
        if(!$newUser)
            return json_encode($data["errors"]=["creation" => "pb lors la màj de votre image d'utilisateur"]);
        unset($dbUser);

        // MàJ de la table rightsTeam
        $riTeam = new rightsteam([
            'id'=>0,
            'idUser'=>$newUser->getId(),
            'idTeam'=>$newTeam->getId(),
            'right'=>1,
            'title'=>'maitre',
            'description'=>'Un pour les controler tous'
        ]);
        $dbRightsTeam = new rightsteamManager();
        $newRiTeam = $dbRightsTeam->create($riTeam);
        if(!$newRiTeam)
            return json_encode($data["errors"]=["creation" => "pb lors la creation de vos droits"]);
        unset($dbRightsTeam);

        return json_encode(["success" => true]);    
	}
}