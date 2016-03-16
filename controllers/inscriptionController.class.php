<?php

class inscriptionController{

	public function inscriptionAction(){
		$v = new View();
		$v->assign("css", "inscription");
		$v->assign("js", "inscription");
		$v->assign("title", "Rejoignez-nous !");
		$v->assign("content", "S'inscrire à Break-em all !");
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

		foreach ($args as $key => $value) {
			if(!isset($filteredinputs[$key]))
				die("FAUX: ".$filteredinputs[$key]);
		}

		$email = $filteredinputs['email'];

		if(strlen($filteredinputs['pseudo'])<2 || strlen($filteredinputs['pseudo'])>45)
        	die("FAIL pseudo");	
        else
 	       $pseudo=trim($filteredinputs['pseudo']);

        if($filteredinputs['password']!==$filteredinputs['password_check'])
        	die("FAIL pwd");
        else
        	$pwd=password_hash($filteredinputs['password'], PASSWORD_DEFAULT);

        if(!checkdate($filteredinputs['month'], $filteredinputs['day'], $filteredinputs['year']))
        	die("FAIL date crea");
        else{
        	$date = DateTime::createFromFormat('j-n-Y',$filteredinputs['day'].'-'.$filteredinputs['month'].'-'.$filteredinputs['year']);
        	if(!$date)
        		die("FAIL date format");
        	$datebdd=date_timestamp_get($date);
        }
        //$datebdd / $pwd / $email / $pseudo
	}
}
