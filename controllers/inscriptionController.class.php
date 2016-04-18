<?php

class inscriptionController extends template{

	public function inscriptionAction(){
		$v = new View();
		$v->assign("css", "inscription");
		$v->assign("js", "inscription");
		$v->assign("title", "Rejoignez-nous !");
		$v->assign("content", "S'inscrire a Break-em all !");
		$v->setView("inscription");
	}

	public function verifyAction(){
		$args = array(
    	    'pseudo'     => FILTER_SANITIZE_STRING,
    	    'email'   => FILTER_VALIDATE_EMAIL,
    	    'password'   => FILTER_SANITIZE_STRING,
    	    'password_check'   => FILTER_SANITIZE_STRING,
    	    'day'   => FILTER_VALIDATE_INT,	    
    	    'month'   => FILTER_VALIDATE_INT,	    
    	    'year'   => FILTER_VALIDATE_INT	    
		);
		$filteredinputs = filter_input_array(INPUT_POST, $args);
		// Ce finalArr doit etre envoyé au parametre du constructeur de usermanager
		$finalArr = [];

		foreach ($args as $key => $value) {
			if(!isset($filteredinputs[$key]))
				die("FAUX: ".$filteredinputs[$key]);
		}

		$finalArr['email'] = $filteredinputs['email'];

		if(strlen($filteredinputs['pseudo'])<2 || strlen($filteredinputs['pseudo'])>45)
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
        }
        
        // Le user ici servira d'image des user recuperes par la bdd et tout juste créés
        $user = new user($finalArr);
        // var_dump($user);

        // C'est avec cet objet qu'on utilisera les fonctions d'interaction avec la base de donnees
        $userBDD = new userManager();
        // On check l'utilisation du pseudo
        $exist_pseudo=$userBDD->pseudoExists($user->getPseudo());
        if($exist_pseudo)
        	die("User already used !");

        // On check celle de l'email
        $exist_email=$userBDD->emailExists($user->getEmail());
        if($exist_email)
        	die("Email already used");

        // On enregistre !
        $userBDD->create($user);
            
	}
}
