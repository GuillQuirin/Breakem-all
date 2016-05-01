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
		if(isset($_SERVER["HTTP_REFERER"])){
			
			$e = new Exception();
			$trace = $e->getTrace();

			// Classe appelante
			$calling_class = (isset($trace[0]['class'])) ? $trace[0]['class'] : false;
			echo "<pre>";
			var_dump($_SERVER);		
			//Methode appelante
			$calling_method = str_replace("http://".$_SERVER["HTTP_HOST"].WEBPATH."/","",$_SERVER["HTTP_REFERER"]);
			var_dump($calling_method);
			if($calling_class === "configurationController" && $calling_method === "update")
				$v->assign("MAJ","1");
		}
		
		/* Affichage des informations */

		$user = parent::getConnectedUser();
		if(isset($user)){

			$args = array(
						'pseudo',	
						'name',
						'firstname',
						'birthday',
						'description',
						'kind',
						'city',
						'email',
						'status',
						'img',
						'idTeam',
						'isConnected',
						'token'
					);
			foreach ($args as $key => $value) {
				$method = 'get'.ucfirst($value);
				if (method_exists($user, $method)) {
					$v->assign($value, $user->$method());
				}
			}
		}
		else
			$v->assign("err", "1");

		$v->setView("configuration");
	}
	
	public function updateAction(){

		header("Location: ".WEBPATH."/configuration");

	}

}
