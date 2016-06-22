<?php

class configurationController extends template{
	
	public function __construct(){
		parent::__construct();

		//Visiteur ou membre banni
		if(!($this->isVisitorConnected()) || !$this->connectedUser || $this->connectedUser->getStatus()<1){
		 	header('Location: ' .WEBPATH);
		}
	}

	public function configurationAction(){

		$v = new view();
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

			if(isset($_SESSION['err_img_upload'])){
				$v->assign("err_img_upload","1");
				unset($_SESSION["err_img_upload"]);
			}
			
			if(isset($_SESSION['err_img_size'])){
				$v->assign("err_img_size","1");
				unset($_SESSION["err_img_size"]);				
			}

			if(isset($_SESSION['fail_date'])){
				$v->assign("fail_date","1");
				unset($_SESSION["fail_date"]);				
			}

			if(isset($_SESSION['fail_email'])){
				$v->assign("fail_email","1");
				unset($_SESSION["fail_email"]);				
			}

			if(isset($_SESSION['double_email'])){
				$v->assign("double_email","1");
				unset($_SESSION["double_email"]);				
			}

			if(isset($_SESSION['fail_password'])){
				$v->assign("fail_password","1");
				unset($_SESSION["fail_password"]);				
			}

			if(isset($_SESSION['empty_password'])){
				$v->assign("empty_password","1");
				unset($_SESSION["empty_password"]);				
			}

			unset($_SESSION['referer_method']);
		}		

		//Team
		$team = new teamManager();
		if(isset($_idTeam) && $_idTeam!==NULL)
			$v->assign("imgTeam", $team->getTeam(array('id'=>$_idTeam))->getImg());

		//Liste des jeux
		$jeux = new gameManager();
		$v->assign("listeJeux", $jeux->getAllNames());

		$v->setView("configuration");
	}
	
	public function updateAction(){
	    //  infos récuperées après filtre de sécurité de checkUpdateInputs()
	    $checkedDatas = $this->checkUpdateInputs();
	   
	    $user = $this->getConnectedUser();
		
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

	//Methode présente dans Controller et non template car on ne peut faire de MAJ qu'ici
	private function checkUpdateInputs(){

		//FILTER_SANITIZE_STRING Remove all HTML tags from a string
	    $args = array(
	      'email'   => FILTER_VALIDATE_EMAIL,
	      'password'   => FILTER_SANITIZE_STRING,
	      'new_password'   => FILTER_SANITIZE_STRING,
	      'new_password_check'   => FILTER_SANITIZE_STRING,
	      'description'   => FILTER_SANITIZE_STRING,
	      'day'   => FILTER_SANITIZE_STRING,     
	      'month'   => FILTER_SANITIZE_STRING,     
	      'year'   => FILTER_SANITIZE_STRING,
	      //'aff_naissance' => FILTER_VALIDATE_INT,     
	      //'rss' => FILTER_VALIDATE_BOOLEAN,     
	      'authorize_mail_contact' => FILTER_VALIDATE_BOOLEAN
	    );

		$filteredinputs = filter_input_array(INPUT_POST, $args);

		//Date de naissance
		$filteredinputs['month'] = (int) $filteredinputs['month'];
	    $filteredinputs['day'] = (int) $filteredinputs['day'];
	    $filteredinputs['year'] = (int) $filteredinputs['year'];
	    
	    if(!checkdate($filteredinputs['month'], $filteredinputs['day'], $filteredinputs['year']))
	    	$_SESSION['fail_date']=1;
	    else{
	      $date = DateTime::createFromFormat('j-n-Y',$filteredinputs['day'].'-'.$filteredinputs['month'].'-'.$filteredinputs['year']);
	      
	      if(!$date)
	        $_SESSION['fail_date']=1;

	      $filteredinputs['birthday'] = date_timestamp_get($date);
	    }

		//IMAGE DE PROFIL

		if(isset($_FILES['profilpic'])){

			$uploaddir = '/web/img/upload/';
			$uploadfile = getcwd().$uploaddir.$this->getConnectedUser()->getId().'.jpg';

			define('KB', 1024);
			define('MB', 1048576);
			define('GB', 1073741824);
			define('TB', 1099511627776);

			if($_FILES['profilpic']['size'] < 3*MB){
				if($_FILES['profilpic']['error']==0){
					if(!move_uploaded_file($_FILES['profilpic']['tmp_name'], $uploadfile))
					   $_SESSION['err_img_upload']=1;
				}
			}
			else
				$_SESSION['err_img_size']=1;

			$filteredinputs['img'] = $this->getConnectedUser()->getId().'.jpg';
    	}

    	//Si le mdp saisi est OK
    	if(ourOwnPassVerify($filteredinputs['password'], $this->getConnectedUser()->getPassword())){
    		
    		/*HASHAGE DU MOT DE PASSE*/
    			$filteredinputs['password']=ourOwnPassHash($filteredinputs['password']); 

    		//Email
		    if(!isset($filteredinputs['email']))
				$_SESSION['fail_email']=1;
			else{
				$userBDD = new userManager();

				$exist_email=$userBDD->emailExists($filteredinputs['email']);
		    	if($filteredinputs['email']!=$_SESSION[COOKIE_EMAIL] && $exist_email)
		     		$_SESSION['double_email']=1;
			}

			//Password  
		    if(isset($filteredinputs['new_password']) && isset($filteredinputs['new_password_check'])
		    	&& !empty($filteredinputs['new_password']) && !empty($filteredinputs['new_password_check'])){
		    	
		    	if(strlen($filteredinputs['new_password'])<2 || strlen($filteredinputs['new_password'])>15)
			      $_SESSION['fail_password']=1; 
			  	else
			  		$filteredinputs['password']=ourOwnPassHash($filteredinputs['new_password']);
		    }
    	}
    	else{
    		$_SESSION['empty_password']=1;
    		unset($filteredinputs['password']);//On retire le mdp pour éviter toute update
    	}

	    return array_filter($filteredinputs);
  	}

}
