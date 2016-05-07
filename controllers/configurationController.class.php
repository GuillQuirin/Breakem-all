<?php

class configurationController extends template{
	
	public function __construct(){
		parent::__construct();
		 if(!($this->isVisitorConnected())){
		 	header('Location: ' .WEBPATH);
		}
	}

	public function configurationAction(){

		$v = new View();
		$this->assignConnectedProperties($v);
		$v->assign("css", "configuration");
		$v->assign("js", "configuration");
		$v->assign("title", "configuration");
		$v->assign("content", "Configurer votre profil");

		/*MAJ du profil effectuée auparavant (/update) ? */
		if(isset($_SESSION['referer_method'])){
			
			$e = new Exception();
			$trace = $e->getTrace();

			// Classe appelante
			$calling_class = (isset($trace[0]['class'])) ? $trace[0]['class'] : false;

			//Methode appelante
			$calling_method = $_SESSION['referer_method'];

			if($calling_class === "configurationController" && $calling_method === "update")
				$v->assign("MAJ","1");

			unset($_SESSION['referer_method']);
		}		
		$v->setView("configuration");
	}
	
	public function updateAction(){
	    //  infos récuperées après filtre de sécurité de checkUpdateInputs()
	    $checkedDatas = $this->checkUpdateInputs();

	    $user = $this->getConnectedUser();
		
	    // C'est avec cet objet qu'on utilisera les fonctions d'interaction avec la base de donnees
	    $userBDD = new userManager();
	    $newuser = new user($checkedDatas);

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

	//Methode présente dans Controller et non template car on ne peut faire de MAJ qu'ici
	private function checkUpdateInputs(){
	    $args = array(
	      'email'   => FILTER_VALIDATE_EMAIL,
	      'password'   => FILTER_SANITIZE_STRING,
	      'new_password'   => FILTER_SANITIZE_STRING,
	      'new_password_check'   => FILTER_SANITIZE_STRING,
	      'description'   => FILTER_SANITIZE_STRING,
	      'day'   => FILTER_VALIDATE_INT,     
	      'month'   => FILTER_VALIDATE_INT,     
	      'year'   => FILTER_VALIDATE_INT,
	      //'aff_naissance' => FILTER_VALIDATE_INT,     
	      'rss' => FILTER_VALIDATE_BOOLEAN,     
	      'authorize_mail_contact' => FILTER_VALIDATE_BOOLEAN
	    );

		$filteredinputs = filter_input_array(INPUT_POST, $args);

		//IMAGE DE PROFIL
		if(isset($_FILES['profilpic'])){

			$uploaddir = '/web/img/upload/';
			$uploadfile = getcwd().$uploaddir.$this->getConnectedUser()->getId().'.jpg';

			define('KB', 1024);
			define('MB', 1048576);
			define('GB', 1073741824);
			define('TB', 1099511627776);

			if($_FILES['profilpic']['size'] < 1*MB){
				if($_FILES['profilpic']['error']==0){
					if(!move_uploaded_file($_FILES['profilpic']['tmp_name'], $uploadfile))
					   exit;
				}
			}
			$filteredinputs['img'] = $this->getConnectedUser()->getId().'.jpg';
    	}

    	//Si le mdp saisi est OK
    	if(ourOwnPassVerify($filteredinputs['password'], $this->getConnectedUser()->getPassword())){
    		
    		/*HASHAGE DU MOT DE PASSE*/
    			$filteredinputs['password']=ourOwnPassHash($filteredinputs['password']); 

    		//Email
		    if(!isset($filteredinputs['email']))
				$this->echoJSONerror('inputs', 'adresse email non vide');
			else{
				$userBDD = new userManager();

				$exist_email=$userBDD->emailExists($filteredinputs['email']);
		    	if($filteredinputs['email']!=$_SESSION[COOKIE_EMAIL] && $exist_email)
		     		$this->echoJSONerror('email', 'cet email est déjà utilisé');
			}

			//Password  
		    if(isset($filteredinputs['new_password']) && isset($filteredinputs['new_password_check'])
		    	&& !empty($filteredinputs['new_password']) && !empty($filteredinputs['new_password_check'])){
		    	
		    	if(strlen($filteredinputs['new_password'])<2 || strlen($filteredinputs['new_password'])>15)
			      $this->echoJSONerror('password', 'votre nouveau mot de passe doit faire entre 2 et 15 caracteres'); 
			  	else
			  		$filteredinputs['password']=ourOwnPassHash($filteredinputs['new_password']);
		    }
    	}
    	else
    		$this->echoJSONerror('password', 'Mot de passe obligatoire');

	    //Date de naissance
		    // if(!checkdate($filteredinputs['month'], $filteredinputs['day'], $filteredinputs['year']))
		    //   $this->echoJSONerror('date', 'La date reçue a fail !');
		    // else{
		    //   $date = DateTime::createFromFormat('j-n-Y',$filteredinputs['day'].'-'.$filteredinputs['month'].'-'.$filteredinputs['year']);
		    //   if(!$date)
		    //     $this->echoJSONerror('date', 'La date reçue a fail !');
		    //   $finalArr['birthday'] = date_timestamp_get($date);
	    // }
	    return array_filter($filteredinputs);
  	}

}
