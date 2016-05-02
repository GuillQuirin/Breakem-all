<?php

class profilController extends template{

	public function profilAction(){
		
		$v = new View();
		$this->assignConnectedProperties($v);
		$v->assign("css", "profil");
		$v->assign("js", "profil");
		$v->assign("title", "Profil");
		$v->assign("content", "Fiche de l'utilisateur");

		if(isset($_GET['pseudo'])){
			// Ce finalArr doit etre envoyé au parametre du constructeur de usermanager
			$userBDD = new userManager();

			$args = array('pseudo' => FILTER_SANITIZE_STRING );

			$filteredinputs = array_filter(filter_input_array(INPUT_GET, $args));

			$user = $userBDD->getUser($filteredinputs);

			// Si $user === FALSE : soit pas de user trouvé, soit pbm de requete

			$args = array(
				'pseudo' => FILTER_SANITIZE_STRING,
				'name' => FILTER_SANITIZE_STRING,
				'firstname' => FILTER_SANITIZE_STRING,
				'birthday' => FILTER_SANITIZE_STRING,
				'description' => FILTER_SANITIZE_STRING,
				'kind' => FILTER_SANITIZE_STRING,
				'city' => FILTER_SANITIZE_STRING,
				'email' => FILTER_VALIDATE_EMAIL,
				'status' => FILTER_SANITIZE_STRING,
				'img' => FILTER_SANITIZE_STRING,
				'idTeam' => FILTER_SANITIZE_STRING,
				'token' => FILTER_SANITIZE_STRING
			);

			if($user!==FALSE){
				foreach ($args as $key => $value) {
					$method = 'get'.ucfirst($key);
					if (method_exists($user, $method)) {
						$v->assign($key, $user->$method());
					}
				}
			}
			else{
				$v->assign("err", "1");
			}
		}
		else{
			$v->assign("err", "1");
		}
		$v->setView("profil");
	}
}
