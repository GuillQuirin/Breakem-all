<?php

class tournoiController extends template {

	public function tournoiAction(){
		$v = new View();
		$v->assign("css", "tournoi");
		$v->assign("js", "tournoi");
		$v->assign("title", "Tournois");
		$v->assign("content", "Liste principaux tournois jeux vidéos");
		$v->setView("tournoiDOM");
	}

	public function verifyAction(){    

		/* http://localhost:8888/esgi/Breakem-all/tournoi/verify?
				id=0&description=%22TEST%22&playerMin=1&playerMax=5&typeTournament=1&status=1&nbMatch=15
		*/

		$args = array(
			'id'	=>FILTER_VALIDATE_INT,
		    //'startDate'    => FILTER_SANITIZE_STRING,
		    //'endDate'    => FILTER_SANITIZE_STRING,
		    'description'    => FILTER_SANITIZE_STRING,
		    'playerMin'	=>FILTER_VALIDATE_INT,
		    'playerMax'	=>FILTER_VALIDATE_INT,
		    'typeTournament'	=>FILTER_VALIDATE_INT,
		    'status'	=>FILTER_VALIDATE_INT,
		    'nbMatch'	=>FILTER_VALIDATE_INT,
		    //'idUserCreator'	=>FILTER_VALIDATE_INT,
		    //'idGameVersion'	=>FILTER_VALIDATE_INT,
		    //'idWinningTeam'	=>FILTER_VALIDATE_INT,
		    //'urlProof'   => FILTER_SANITIZE_STRING
		);
		$filteredinputs = filter_input_array(INPUT_GET, $args);

		// Ce finalArr doit etre envoyé au parametre du constructeur de usermanager
		$finalArr = [];

		foreach ($args as $key => $value) {
			if(!isset($filteredinputs[$key]))
				die("FAUX: ".$filteredinputs[$key]);
		}


		/*if(strlen($filteredinputs['pseudo'])<2 || strlen($filteredinputs['pseudo'])>45)
        	die("FAIL pseudo");	
        else
 	       $finalArr['pseudo']=trim($filteredinputs['pseudo']);

        if($filteredinputs['password']!==$filteredinputs['password_check'])
        	die("FAIL pwd");
        else
        	$finalArr['password']=password_hash($filteredinputs['password'], PASSWORD_DEFAULT);

        if(!checkdate($filteredinputs['month'], $filteredinputs['day'], $filteredinputs['year']))
        	die("FAIL date crea");
        else{
        	$date = DateTime::createFromFormat('j-n-Y',$filteredinputs['day'].'-'.$filteredinputs['month'].'-'.$filteredinputs['year']);
        	if(!$date)
        		die("FAIL date format");
        	$finalArr['birthday'] = date_timestamp_get($date);
        }*/
        
        // Le user ici servira d'image des user recuperes par la bdd et tout juste créés
        $tournoi = new tournoi($filteredinputs); //$finalArr);
        // var_dump($user);

        // C'est avec cet objet qu'on utilisera les fonctions d'interaction avec la base de donnees
        $tournoiBDD = new tournoiManager();

        // On check l'utilisation du pseudo
        $exist_tournoi=$tournoiBDD->idExists($tournoi->getId());
        if($exist_pseudo)
        	die("Tournament already used !");


        // On enregistre !
        $tournoiBDD->create($tournoi);
        
	}
	
}
