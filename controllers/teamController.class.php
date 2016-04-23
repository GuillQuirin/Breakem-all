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


        $teamCrea = new team($finalArr);
        $teamBDD = new teamManager();

        //Absence du nom en BDD
        $teamRecup = $teamBDD->tryBring($teamCrea->getName());
        var_dump($teamRecup);
        if($teamRecup)
            die("Team already exists!");

        //Absence d'appartenance à une autre team
       // $teamRecup = $teamBDD->rightsExists($_SESSION['id']);
        //if($teamRecup)
        //    die("User already has a team !");

        //Créaton team
        $teamBDD->create($teamCrea);

        $teamRecup = $teamBDD->tryBring($teamCrea->getName());

        //$teamBDD->setOwnerTeam($teamRecup->getId(), 1);

    
	}
}